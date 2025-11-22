<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'service_id',
        'appointment_date',
        'appointment_time',
        'status',
        'notes',
        'payment_status',
    ];

    protected $casts = [
        'appointment_date' => 'date',
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_REJECTED = 'rejected';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_COMPLETED = 'completed';

    const PAYMENT_STATUS_PENDING = 'pending';
    const PAYMENT_STATUS_PAID = 'paid';
    const PAYMENT_STATUS_REFUNDED = 'refunded';

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function refund()
    {
        return $this->hasOne(Refund::class);
    }

    public function canBeCancelled()
    {
        $minDate = Carbon::now()->addDays(3);
        return $this->appointment_date->gte($minDate);
    }
}

