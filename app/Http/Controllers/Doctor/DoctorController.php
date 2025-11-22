<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function dashboard()
    {
        $doctor = auth()->user()->doctor;
        $todayAppointments = Appointment::where('doctor_id', $doctor->id)
            ->whereDate('appointment_date', today())
            ->where('status', 'accepted')
            ->with(['patient', 'service'])
            ->get();

        return view('doctor.dashboard', compact('todayAppointments'));
    }

    public function profile()
    {
        $doctor = auth()->user()->doctor;
        return view('doctor.profile', compact('doctor'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $doctor = $user->doctor;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'specialization' => 'required|string|max:255',
            'experience' => 'nullable|integer|min:0',
            'qualification' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'consultation_fee' => 'nullable|numeric|min:0',
        ]);

        try {
            \DB::beginTransaction();

            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'address' => $validated['address'] ?? null,
            ]);

            $doctor->update([
                'specialization' => $validated['specialization'],
                'experience' => $validated['experience'] ?? 0,
                'qualification' => $validated['qualification'] ?? null,
                'bio' => $validated['bio'] ?? null,
                'consultation_fee' => $validated['consultation_fee'] ?? 0,
            ]);

            \DB::commit();

            return back()->with('success', 'Cập nhật thông tin thành công.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return back()->withErrors(['error' => 'Có lỗi xảy ra khi cập nhật thông tin.'])->withInput();
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
        ]);

        $user = auth()->user();

        if (!\Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.'])->withInput();
        }

        $user->update([
            'password' => \Hash::make($request->password),
        ]);

        return back()->with('success', 'Đổi mật khẩu thành công.');
    }

    public function appointments(Request $request)
    {
        $doctor = auth()->user()->doctor;
        $query = Appointment::where('doctor_id', $doctor->id)
            ->with(['patient', 'service']);

        if ($request->date) {
            $query->whereDate('appointment_date', $request->date);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $appointments = $query->latest()->paginate(15);

        return view('doctor.appointments.index', compact('appointments'));
    }

    public function acceptAppointment($id)
    {
        $doctor = auth()->user()->doctor;
        $appointment = Appointment::where('doctor_id', $doctor->id)
            ->findOrFail($id);

        $appointment->update(['status' => Appointment::STATUS_ACCEPTED]);

        \App\Jobs\SendAppointmentNotification::dispatch($appointment, 'accepted');

        return back()->with('success', 'Chấp nhận lịch hẹn thành công.');
    }

    public function rejectAppointment($id)
    {
        $doctor = auth()->user()->doctor;
        $appointment = Appointment::where('doctor_id', $doctor->id)
            ->findOrFail($id);

        $appointment->update(['status' => Appointment::STATUS_REJECTED]);

        \App\Jobs\SendAppointmentNotification::dispatch($appointment, 'rejected');

        return back()->with('success', 'Từ chối lịch hẹn thành công.');
    }

    public function history()
    {
        $doctor = auth()->user()->doctor;
        $appointments = Appointment::where('doctor_id', $doctor->id)
            ->whereIn('status', ['completed', 'cancelled'])
            ->with(['patient', 'service'])
            ->latest()
            ->paginate(15);

        return view('doctor.history', compact('appointments'));
    }
}

