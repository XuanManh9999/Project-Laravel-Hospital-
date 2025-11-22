<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    const ROLE_ADMIN = 'admin';
    const ROLE_DOCTOR = 'doctor';
    const ROLE_RECEPTIONIST = 'receptionist';
    const ROLE_PATIENT = 'patient';

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

    public function receptionist()
    {
        return $this->hasOne(Receptionist::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isDoctor()
    {
        return $this->role === self::ROLE_DOCTOR;
    }

    public function isReceptionist()
    {
        return $this->role === self::ROLE_RECEPTIONIST;
    }

    public function isPatient()
    {
        return $this->role === self::ROLE_PATIENT;
    }
}

