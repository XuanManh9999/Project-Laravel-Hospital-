<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class ReceptionistController extends Controller
{
    public function dashboard()
    {
        $todayAppointments = Appointment::whereDate('appointment_date', today())
            ->with(['patient', 'doctor.user', 'service'])
            ->latest()
            ->get();

        return view('receptionist.dashboard', compact('todayAppointments'));
    }

    public function profile()
    {
        $receptionist = auth()->user()->receptionist;
        return view('receptionist.profile', compact('receptionist'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $receptionist = $user->receptionist;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'shift' => 'nullable|string|max:255',
        ]);

        try {
            \DB::beginTransaction();

            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'address' => $validated['address'] ?? null,
            ]);

            $receptionist->update([
                'shift' => $validated['shift'] ?? null,
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
        $query = Appointment::with(['patient', 'doctor.user', 'service']);

        if ($request->date) {
            $query->whereDate('appointment_date', $request->date);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $appointments = $query->latest()->paginate(15);

        return view('receptionist.appointments.index', compact('appointments'));
    }
}

