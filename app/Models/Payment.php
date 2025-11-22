<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'amount',
        'payment_method',
        'transaction_id',
        'status',
        'vnpay_response',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'vnpay_response' => 'array',
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_SUCCESS = 'success';
    const STATUS_FAILED = 'failed';

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}

