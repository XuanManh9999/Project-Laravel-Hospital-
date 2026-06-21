<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'avatar',
        'specialization',
        'experience',
        'qualification',
        'bio',
        'consultation_fee',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function getAvatarAttribute($value)
    {
        if (!$value) {
            return null;
        }
        if (preg_match('/^(https?:\/\/|data:)/i', $value)) {
            return $value;
        }
        return asset('storage/' . $value);
    }
}

