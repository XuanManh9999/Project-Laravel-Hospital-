<?php

namespace App\Jobs;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendAppointmentNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $appointment;
    protected $action;

    public function __construct(Appointment $appointment, string $action)
    {
        $this->appointment = $appointment;
        $this->action = $action;
    }

    public function handle(): void
    {
        $patient = $this->appointment->patient;
        $doctor = $this->appointment->doctor->user;

        $subject = $this->action === 'accepted' 
            ? 'Lịch hẹn của bạn đã được chấp nhận'
            : 'Lịch hẹn của bạn đã bị từ chối';

        Mail::send('emails.appointment-notification', [
            'appointment' => $this->appointment,
            'doctor' => $doctor,
            'action' => $this->action,
        ], function ($message) use ($patient, $subject) {
            $message->to($patient->email, $patient->name)
                    ->subject($subject);
        });
    }
}

