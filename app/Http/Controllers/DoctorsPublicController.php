<?php

namespace App\Http\Controllers;

use App\Models\Doctor;

class DoctorsPublicController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('user')
            ->whereHas('user', function ($q) {
                $q->where('status', 'active');
            })
            ->orderBy('id')
            ->paginate(8);

        return view('doctors.index', compact('doctors'));
    }
}
