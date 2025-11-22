<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'amount',
        'reason',
        'status',
        'processed_by',
        'processed_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'processed_at' => 'datetime',
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSED = 'processed';
    const STATUS_REJECTED = 'rejected';

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function processor()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
}

