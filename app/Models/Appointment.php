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
    const STATUS_WAITING_EXAMINATION = 'waiting_examination';
    const STATUS_REJECTED = 'rejected';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_COMPLETED = 'completed';

    const PAYMENT_STATUS_PENDING = 'pending';
    const PAYMENT_STATUS_PAID = 'paid';
    const PAYMENT_STATUS_REFUNDED = 'refunded';

    public const SHIFT_MORNING_START = '08:00:00';
    public const SHIFT_MORNING_END = '12:00:00';
    public const SHIFT_AFTERNOON_START = '13:00:00';
    public const SHIFT_AFTERNOON_END = '18:00:00';

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

    public function getShiftLabelAttribute(): string
    {
        if (!$this->appointment_time) {
            return '';
        }

        $time = Carbon::createFromFormat('H:i:s', $this->appointment_time);

        if ($time->betweenIncluded(
            Carbon::createFromTimeString(self::SHIFT_MORNING_START),
            Carbon::createFromTimeString(self::SHIFT_MORNING_END)
        )) {
            return 'Ca sáng (8h - 12h)';
        }

        if ($time->betweenIncluded(
            Carbon::createFromTimeString(self::SHIFT_AFTERNOON_START),
            Carbon::createFromTimeString(self::SHIFT_AFTERNOON_END)
        )) {
            return 'Ca chiều (13h - 18h)';
        }

        return $time->format('H:i');
    }
}

