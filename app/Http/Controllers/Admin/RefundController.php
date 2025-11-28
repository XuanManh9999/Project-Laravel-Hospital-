<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Refund;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    public function index(Request $request)
    {
        $query = Refund::with(['appointment.patient', 'processor']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('appointment.patient', function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            })->orWhere('reason', 'like', '%' . $search . '%');
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $refunds = $query->latest()->paginate(15)->withQueryString();

        return view('admin.refunds.index', compact('refunds'));
    }

    public function process($id)
    {
        $refund = Refund::findOrFail($id);
        
        $refund->update([
            'status' => Refund::STATUS_PROCESSED,
            'processed_by' => auth()->id(),
            'processed_at' => now(),
        ]);

        $appointment = $refund->appointment;
        $appointment->update([
            'payment_status' => \App\Models\Appointment::PAYMENT_STATUS_REFUNDED,
        ]);

        return back()->with('success', 'Xử lý hoàn tiền thành công.');
    }

    public function reject($id, Request $request)
    {
        $refund = Refund::findOrFail($id);
        
        $refund->update([
            'status' => Refund::STATUS_REJECTED,
            'processed_by' => auth()->id(),
            'reason' => $request->reason ?? 'Không đủ điều kiện hoàn tiền',
        ]);

        return back()->with('success', 'Từ chối hoàn tiền thành công.');
    }

    public function bulkAction(Request $request)
    {
        $validated = $request->validate([
            'action' => 'required|in:process,reject',
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:refunds,id',
            'reason_bulk' => 'nullable|string|max:1000',
        ]);

        $refunds = Refund::with('appointment')
            ->whereIn('id', $validated['ids'])
            ->where('status', Refund::STATUS_PENDING)
            ->get();

        $processedCount = 0;

        foreach ($refunds as $refund) {
            if ($validated['action'] === 'process') {
                $refund->update([
                    'status' => Refund::STATUS_PROCESSED,
                    'processed_by' => auth()->id(),
                    'processed_at' => now(),
                ]);

                $appointment = $refund->appointment;
                if ($appointment) {
                    $appointment->update([
                        'payment_status' => \App\Models\Appointment::PAYMENT_STATUS_REFUNDED,
                    ]);
                }
            } else {
                // reject
                $refund->update([
                    'status' => Refund::STATUS_REJECTED,
                    'processed_by' => auth()->id(),
                    'reason' => $validated['reason_bulk'] ?: ($refund->reason ?: 'Không đủ điều kiện hoàn tiền'),
                ]);
            }

            $processedCount++;
        }

        if ($processedCount === 0) {
            return back()->withErrors(['error' => 'Không có yêu cầu hoàn tiền hợp lệ để xử lý.']);
        }

        $message = $validated['action'] === 'process'
            ? "Đã xử lý hoàn tiền cho {$processedCount} yêu cầu."
            : "Đã từ chối {$processedCount} yêu cầu hoàn tiền.";

        return back()->with('success', $message);
    }
}

