<?php

namespace App\Jobs;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendCancellationRefundEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function handle(): void
    {
        $patient = $this->appointment->patient;

        Mail::send('emails.cancellation-refund', [
            'appointment' => $this->appointment,
        ], function ($message) use ($patient) {
            $message->to($patient->email, $patient->name)
                    ->subject('Thông báo hủy lịch hẹn và hoàn tiền');
        });
    }
}

