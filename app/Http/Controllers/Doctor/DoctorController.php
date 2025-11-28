<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Payment;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function dashboard()
    {
        $doctor = auth()->user()->doctor;
        $todayAppointments = Appointment::where('doctor_id', $doctor->id)
            ->whereDate('appointment_date', today())
            ->whereIn('status', [Appointment::STATUS_ACCEPTED, Appointment::STATUS_WAITING_EXAMINATION])
            ->with(['patient', 'service'])
            ->orderBy('appointment_time')
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

        if ($request->patient_name) {
            $query->whereHas('patient', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->patient_name . '%');
            });
        }

        $appointments = $query->latest()->paginate(15)->withQueryString();

        return view('doctor.appointments.index', compact('appointments'));
    }

    public function showAppointment($id)
    {
        $doctor = auth()->user()->doctor;
        $appointment = Appointment::where('doctor_id', $doctor->id)
            ->with(['patient', 'service'])
            ->findOrFail($id);

        return view('doctor.appointments.show', compact('appointment'));
    }

    public function acceptAppointment($id)
    {
        $doctor = auth()->user()->doctor;
        $appointment = Appointment::where('doctor_id', $doctor->id)
            ->with('payment')
            ->findOrFail($id);
        
        // Chỉ cho phép chấp nhận khi bệnh nhân đã thanh toán thành công
        $hasSuccessfulPayment = $appointment->payment
            && $appointment->payment->status === Payment::STATUS_SUCCESS;

        if (!$hasSuccessfulPayment) {
            return back()->withErrors(['error' => 'Bệnh nhân chưa thanh toán, không thể chấp nhận lịch hẹn.']);
        }

        // Xác định ca khám hiện tại (sáng/chiều) dựa trên giờ hẹn
        $time = $appointment->appointment_time;
        $isMorning = $time >= Appointment::SHIFT_MORNING_START && $time <= Appointment::SHIFT_MORNING_END;

        $shiftStart = $isMorning ? Appointment::SHIFT_MORNING_START : Appointment::SHIFT_AFTERNOON_START;
        $shiftEnd = $isMorning ? Appointment::SHIFT_MORNING_END : Appointment::SHIFT_AFTERNOON_END;

        // Đếm số lịch đã được thanh toán (payment_status = paid) và đã được chấp nhận / chờ khám / hoàn thành trong cùng ca
        $existingPaidConfirmed = Appointment::where('doctor_id', $doctor->id)
            ->whereDate('appointment_date', $appointment->appointment_date)
            ->whereBetween('appointment_time', [$shiftStart, $shiftEnd])
            ->whereIn('status', [
                Appointment::STATUS_ACCEPTED,
                Appointment::STATUS_WAITING_EXAMINATION,
                Appointment::STATUS_COMPLETED,
            ])
            ->where('payment_status', Appointment::PAYMENT_STATUS_PAID)
            ->count();

        if ($existingPaidConfirmed >= 3) {
            return back()->withErrors(['error' => 'Ca khám này đã đủ 3 bệnh nhân đã thanh toán, không thể chấp nhận thêm.']);
        }

        $appointment->update(['status' => Appointment::STATUS_ACCEPTED]);

        \App\Jobs\SendAppointmentNotification::dispatch($appointment, 'accepted');

        return back()->with('success', 'Chấp nhận lịch hẹn thành công.');
    }

    public function rejectAppointment($id)
    {
        $doctor = auth()->user()->doctor;
        $appointment = Appointment::where('doctor_id', $doctor->id)
            ->with('payment')
            ->findOrFail($id);

        try {
            \DB::beginTransaction();

            // Nếu lịch hẹn đã thanh toán, tạo yêu cầu hoàn tiền
            if ($appointment->payment_status === Appointment::PAYMENT_STATUS_PAID && $appointment->payment) {
                // Kiểm tra xem đã có refund chưa để tránh tạo trùng
                $existingRefund = \App\Models\Refund::where('appointment_id', $appointment->id)->first();
                
                if (!$existingRefund) {
                    \App\Models\Refund::create([
                        'appointment_id' => $appointment->id,
                        'amount' => $appointment->payment->amount,
                        'reason' => 'Bác sĩ từ chối lịch hẹn',
                        'status' => \App\Models\Refund::STATUS_PENDING,
                    ]);
                }
            }

            $appointment->update(['status' => Appointment::STATUS_REJECTED]);

            \DB::commit();

            \App\Jobs\SendAppointmentNotification::dispatch($appointment, 'rejected');

            return back()->with('success', 'Từ chối lịch hẹn thành công.' . ($appointment->payment_status === Appointment::PAYMENT_STATUS_PAID ? ' Yêu cầu hoàn tiền đã được tạo.' : ''));
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Error rejecting appointment: ' . $e->getMessage(), [
                'appointment_id' => $appointment->id,
                'doctor_id' => $doctor->id,
            ]);
            return back()->withErrors(['error' => 'Có lỗi xảy ra khi từ chối lịch hẹn. Vui lòng thử lại.']);
        }
    }

    public function startExamination($id)
    {
        $doctor = auth()->user()->doctor;
        $appointment = Appointment::where('doctor_id', $doctor->id)
            ->findOrFail($id);

        if ($appointment->status !== Appointment::STATUS_ACCEPTED) {
            return back()->withErrors(['error' => 'Chỉ có thể bắt đầu khám với lịch hẹn đã được chấp nhận.']);
        }

        // Chỉ cho phép bắt đầu khám trong ngày hẹn hoặc sau ngày hẹn
        if ($appointment->appointment_date->isFuture()) {
            return back()->withErrors(['error' => 'Chỉ có thể bắt đầu khám trong ngày hẹn hoặc sau ngày hẹn.']);
        }

        $appointment->update(['status' => Appointment::STATUS_WAITING_EXAMINATION]);

        return back()->with('success', 'Đã đánh dấu bệnh nhân chờ khám.');
    }

    public function completeAppointment($id)
    {
        $doctor = auth()->user()->doctor;
        $appointment = Appointment::where('doctor_id', $doctor->id)
            ->findOrFail($id);

        // Cho phép hoàn tất từ trạng thái accepted hoặc waiting_examination
        if (!in_array($appointment->status, [Appointment::STATUS_ACCEPTED, Appointment::STATUS_WAITING_EXAMINATION])) {
            return back()->withErrors(['error' => 'Chỉ có thể hoàn tất với lịch hẹn đã được chấp nhận hoặc đang chờ khám.']);
        }

        $appointment->update(['status' => Appointment::STATUS_COMPLETED]);

        return back()->with('success', 'Đã hoàn tất lịch hẹn.');
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

