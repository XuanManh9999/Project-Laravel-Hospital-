<?php

namespace App\Jobs;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendRejectionRefundEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function handle(): void
    {
        try {
            $patient = $this->appointment->patient;
            $doctor = $this->appointment->doctor->user;

            Mail::send('emails.rejection-refund', [
                'appointment' => $this->appointment,
                'doctor' => $doctor,
            ], function ($message) use ($patient) {
                $message->to($patient->email, $patient->name)
                        ->subject('Thông báo từ chối lịch hẹn và hoàn tiền');
            });
        } catch (\Exception $e) {
            \Log::error('Error sending rejection refund email: ' . $e->getMessage(), [
                'appointment_id' => $this->appointment->id,
            ]);
        }
    }
}
