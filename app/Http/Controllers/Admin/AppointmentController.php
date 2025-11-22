<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointment::with(['patient', 'doctor.user', 'service']);

        if ($request->filled('date')) {
            $query->whereDate('appointment_date', $request->date);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        if ($request->filled('doctor_id')) {
            $query->where('doctor_id', $request->doctor_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('patient', function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            })->orWhereHas('doctor.user', function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        $appointments = $query->latest()->paginate(15)->withQueryString();
        $doctors = \App\Models\Doctor::with('user')->get();

        return view('admin.appointments.index', compact('appointments', 'doctors'));
    }

    public function accept($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status' => Appointment::STATUS_ACCEPTED]);

        // Send email notification
        \App\Jobs\SendAppointmentNotification::dispatch($appointment, 'accepted');

        return back()->with('success', 'Chấp nhận lịch hẹn thành công.');
    }

    public function reject($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update(['status' => Appointment::STATUS_REJECTED]);

        // Send email notification
        \App\Jobs\SendAppointmentNotification::dispatch($appointment, 'rejected');

        return back()->with('success', 'Từ chối lịch hẹn thành công.');
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return back()->with('success', 'Xóa lịch hẹn thành công.');
    }
}

