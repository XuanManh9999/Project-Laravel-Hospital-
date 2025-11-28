<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Appointment;
use App\Models\Payment;
use App\Models\Refund;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $dateFrom = $request->input('date_from') ?: now()->subDays(29)->format('Y-m-d');
        $dateTo = $request->input('date_to') ?: now()->format('Y-m-d');
        $groupBy = $request->input('group_by', 'day'); // day, month, year

        $stats = [
            'total_doctors' => \App\Models\Doctor::count(),
            'total_patients' => \App\Models\Patient::count(),
            'total_appointments' => Appointment::count(),
            'pending_appointments' => Appointment::where('status', Appointment::STATUS_PENDING)->count(),
            'accepted_appointments' => Appointment::where('status', Appointment::STATUS_ACCEPTED)->count(),
            'completed_appointments' => Appointment::where('status', Appointment::STATUS_COMPLETED)->count(),
            'cancelled_appointments' => Appointment::where('status', Appointment::STATUS_CANCELLED)->count(),
            'rejected_appointments' => Appointment::where('status', Appointment::STATUS_REJECTED)->count(),

            // Thống kê thanh toán
            'total_revenue' => Payment::where('status', Payment::STATUS_SUCCESS)->sum('amount'),
            'today_revenue' => Payment::where('status', Payment::STATUS_SUCCESS)
                ->whereDate('created_at', today())
                ->sum('amount'),
            'month_revenue' => Payment::where('status', Payment::STATUS_SUCCESS)
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month)
                ->sum('amount'),
            'total_payments' => Payment::count(),
            'successful_payments' => Payment::where('status', Payment::STATUS_SUCCESS)->count(),
            'failed_payments' => Payment::where('status', Payment::STATUS_FAILED)->count(),

            // Hoàn tiền
            'pending_refunds' => Refund::where('status', Refund::STATUS_PENDING)->count(),
            'processed_refunds' => Refund::where('status', Refund::STATUS_PROCESSED)->count(),
        ];

        // Dữ liệu biểu đồ doanh thu
        $paymentsQuery = Payment::where('status', Payment::STATUS_SUCCESS)
            ->whereDate('created_at', '>=', $dateFrom)
            ->whereDate('created_at', '<=', $dateTo);

        $dateFormat = match ($groupBy) {
            'month' => '%Y-%m',
            'year' => '%Y',
            default => '%Y-%m-%d',
        };

        $revenueRows = $paymentsQuery
            ->select([
                DB::raw("DATE_FORMAT(created_at, '{$dateFormat}') as period"),
                DB::raw('SUM(amount) as total_amount'),
                DB::raw('COUNT(*) as total_orders'),
            ])
            ->groupBy('period')
            ->orderBy('period')
            ->get();

        $chartData = [
            'labels' => $revenueRows->pluck('period'),
            'totals' => $revenueRows->pluck('total_amount'),
            'orders' => $revenueRows->pluck('total_orders'),
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
            'group_by' => $groupBy,
        ];

        return view('admin.dashboard', compact('stats', 'chartData'));
    }
}

