<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_doctors' => \App\Models\Doctor::count(),
            'total_patients' => \App\Models\Patient::count(),
            'total_appointments' => \App\Models\Appointment::count(),
            'pending_appointments' => \App\Models\Appointment::where('status', 'pending')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}

