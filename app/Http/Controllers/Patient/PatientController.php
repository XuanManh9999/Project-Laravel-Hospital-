<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class PatientController extends Controller
{
    public function dashboard()
    {
        $patient = auth()->user();
        $upcomingAppointments = Appointment::where('patient_id', $patient->id)
            ->where('status', 'accepted')
            ->whereDate('appointment_date', '>=', today())
            ->with(['doctor.user', 'service'])
            ->latest()
            ->limit(5)
            ->get();

        return view('patient.dashboard', compact('upcomingAppointments'));
    }

    public function profile()
    {
        $patient = auth()->user()->patient;
        return view('patient.profile', compact('patient'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $patient = $user->patient;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'date_of_birth' => 'nullable|date|before:today',
            'gender' => 'nullable|in:male,female,other',
            'medical_history' => 'nullable|string',
            'insurance_number' => 'nullable|string|max:255',
        ]);

        try {
            \DB::beginTransaction();

            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'address' => $validated['address'] ?? null,
            ]);

            $patient->update([
                'date_of_birth' => $validated['date_of_birth'] ?? null,
                'gender' => $validated['gender'] ?? null,
                'medical_history' => $validated['medical_history'] ?? null,
                'insurance_number' => $validated['insurance_number'] ?? null,
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

    public function doctors()
    {
        $doctors = Doctor::with('user')->whereHas('user', function($q) {
            $q->where('status', 'active');
        })->get();

        return view('patient.doctors.index', compact('doctors'));
    }

    public function showDoctor($id)
    {
        $doctor = Doctor::with('user')->findOrFail($id);
        return view('patient.doctors.show', compact('doctor'));
    }

    public function createAppointment($doctorId)
    {
        $doctor = Doctor::with('user')->findOrFail($doctorId);
        $services = Service::where('status', 'active')->get();
        return view('patient.appointments.create', compact('doctor', 'services'));
    }

    public function storeAppointment(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date|after:' . Carbon::now()->addDays(2)->format('Y-m-d') . '|before:' . Carbon::now()->addWeeks(2)->format('Y-m-d'),
            'appointment_time' => 'required|date_format:H:i',
            'notes' => 'nullable|string|max:1000',
        ]);

        $appointment = Appointment::create([
            'patient_id' => auth()->id(),
            'doctor_id' => $validated['doctor_id'],
            'service_id' => $validated['service_id'],
            'appointment_date' => $validated['appointment_date'],
            'appointment_time' => $validated['appointment_time'],
            'notes' => $validated['notes'] ?? null,
            'status' => Appointment::STATUS_PENDING,
        ]);

        return redirect()->route('patient.appointments.show', $appointment->id)
            ->with('success', 'Đặt lịch hẹn thành công. Vui lòng thanh toán để hoàn tất.');
    }

    public function showAppointment($id)
    {
        $appointment = Appointment::with(['doctor.user', 'service', 'payment'])
            ->where('patient_id', auth()->id())
            ->findOrFail($id);

        return view('patient.appointments.show', compact('appointment'));
    }

    public function cancelAppointment($id)
    {
        $appointment = Appointment::where('patient_id', auth()->id())
            ->findOrFail($id);

        if (!$appointment->canBeCancelled()) {
            return back()->withErrors(['error' => 'Chỉ có thể hủy lịch hẹn trước 3 ngày.']);
        }

        if ($appointment->payment_status === Appointment::PAYMENT_STATUS_PAID) {
            // Create refund request
            \App\Models\Refund::create([
                'appointment_id' => $appointment->id,
                'amount' => $appointment->payment->amount,
                'status' => \App\Models\Refund::STATUS_PENDING,
            ]);

            // Send email notification about refund
            \App\Jobs\SendCancellationRefundEmail::dispatch($appointment);
        }

        $appointment->update(['status' => Appointment::STATUS_CANCELLED]);

        return back()->with('success', 'Hủy lịch hẹn thành công.');
    }

    public function history()
    {
        $appointments = Appointment::where('patient_id', auth()->id())
            ->with(['doctor.user', 'service', 'payment'])
            ->latest()
            ->paginate(15);

        return view('patient.history', compact('appointments'));
    }
}

