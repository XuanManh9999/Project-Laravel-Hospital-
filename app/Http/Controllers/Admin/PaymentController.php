<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with([
            'appointment.patient',
            'appointment.doctor.user',
            'appointment.service',
        ]);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('transaction_id', 'like', "%{$search}%")
                    ->orWhereHas('appointment.patient', function ($patientQuery) use ($search) {
                        $patientQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    })
                    ->orWhereHas('appointment.doctor.user', function ($doctorQuery) use ($search) {
                        $doctorQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('amount_min')) {
            $query->where('amount', '>=', $request->amount_min);
        }

        if ($request->filled('amount_max')) {
            $query->where('amount', '<=', $request->amount_max);
        }

        switch ($request->get('sort')) {
            case 'amount_desc':
                $query->orderBy('amount', 'desc');
                break;
            case 'amount_asc':
                $query->orderBy('amount', 'asc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $payments = $query->paginate(15)->withQueryString();

        $stats = [
            'total' => Payment::count(),
            'pending' => Payment::where('status', Payment::STATUS_PENDING)->count(),
            'success' => Payment::where('status', Payment::STATUS_SUCCESS)->count(),
            'failed' => Payment::where('status', Payment::STATUS_FAILED)->count(),
        ];

        return view('admin.payments.index', compact('payments', 'stats'));
    }

    public function show(Payment $payment)
    {
        $payment->load([
            'appointment.patient',
            'appointment.doctor.user',
            'appointment.service',
        ]);

        return view('admin.payments.show', compact('payment'));
    }

    public function updateStatus(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'status' => 'required|in:' . implode(',', [
                Payment::STATUS_PENDING,
                Payment::STATUS_SUCCESS,
                Payment::STATUS_FAILED,
            ]),
        ]);

        $payment->update([
            'status' => $validated['status'],
        ]);

        if ($payment->relationLoaded('appointment') === false) {
            $payment->load('appointment');
        }

        if ($payment->appointment) {
            $appointmentStatus = match ($validated['status']) {
                Payment::STATUS_SUCCESS => Appointment::PAYMENT_STATUS_PAID,
                Payment::STATUS_FAILED => Appointment::PAYMENT_STATUS_PENDING,
                default => $payment->appointment->payment_status,
            };

            $payment->appointment->update([
                'payment_status' => $appointmentStatus,
            ]);
        }

        return back()->with('success', 'Cập nhật trạng thái thanh toán thành công.');
    }
}

