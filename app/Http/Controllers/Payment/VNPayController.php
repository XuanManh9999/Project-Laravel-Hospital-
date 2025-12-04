<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class VNPayController extends Controller
{
    public function createPayment(Request $request, $appointmentId)
    {
        $appointment = Appointment::with(['service', 'doctor'])
            ->where('patient_id', auth()->id())
            ->findOrFail($appointmentId);

        if ($appointment->payment_status === Appointment::PAYMENT_STATUS_PAID) {
            return back()->withErrors(['error' => 'Lịch hẹn này đã được thanh toán.']);
        }

        $vnp_TmnCode = config('services.vnpay.tmn_code');
        $vnp_HashSecret = config('services.vnpay.hash_secret');
        $vnp_Url = config('services.vnpay.url');
        $vnp_ReturnUrl = config('services.vnpay.return_url');

        if (!$vnp_TmnCode || !$vnp_HashSecret || !$vnp_Url || !$vnp_ReturnUrl) {
            Log::error('VNPay configuration is missing', [
                'tmn' => (bool) $vnp_TmnCode,
                'hash' => (bool) $vnp_HashSecret,
                'url' => (bool) $vnp_Url,
                'return_url' => (bool) $vnp_ReturnUrl,
            ]);

            return back()->withErrors(['error' => 'VNPay chưa được cấu hình đúng. Vui lòng liên hệ quản trị viên.']);
        }

        if (!$appointment->service || $appointment->service->price <= 0) {
            return back()->withErrors(['error' => 'Không thể khởi tạo thanh toán cho dịch vụ này.']);
        }

        // Tổng tiền = giá dịch vụ + phí tư vấn bác sĩ
        $consultationFee = $appointment->doctor?->consultation_fee ?? 0;
        $totalAmount = (float) $appointment->service->price + (float) $consultationFee;

        $vnp_TxnRef = 'APPT' . $appointment->id . '_' . time();
        $vnp_OrderInfo = 'Thanh toan lich hen #' . $appointment->id;
        $vnp_OrderType = 'other';
        $vnp_Amount = (int) ($totalAmount * 100); // VNPay sử dụng đơn vị đồng * 100
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $request->ip();

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_ReturnUrl,
            "vnp_TxnRef" => $vnp_TxnRef,
        ];

        ksort($inputData);
        $hashdata = $this->buildHashData($inputData);
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url = $vnp_Url . '?' . http_build_query($inputData) . '&vnp_SecureHash=' . $vnpSecureHash;

        Payment::updateOrCreate(
            ['appointment_id' => $appointment->id],
            [
                'amount' => $totalAmount,
                'payment_method' => 'vnpay',
                'transaction_id' => $vnp_TxnRef,
                'status' => Payment::STATUS_PENDING,
                'vnpay_response' => null,
            ]
        );

        return redirect($vnp_Url);
    }

    public function return(Request $request)
    {
        $vnp_HashSecret = config('services.vnpay.hash_secret');
        $vnp_SecureHash = $request->vnp_SecureHash;

        $inputData = [];
        foreach ($request->all() as $key => $value) {
            if (Str::startsWith($key, 'vnp_')) {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $hashData = $this->buildHashData($inputData);
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash !== $vnp_SecureHash) {
            return $this->paymentFailed(null, 'Chữ ký không hợp lệ.');
        }

        $payment = Payment::where('transaction_id', $request->vnp_TxnRef)->first();

        if (!$payment) {
            Log::warning('Không tìm thấy bản ghi thanh toán cho mã giao dịch.', ['txn' => $request->vnp_TxnRef]);
            return $this->paymentFailed(null, 'Không tìm thấy giao dịch tương ứng.');
        }

        if ($request->vnp_ResponseCode === '00') {
            $payment->update([
                'status' => Payment::STATUS_SUCCESS,
                'vnpay_response' => $request->all(),
            ]);

            $payment->appointment->update([
                'payment_status' => Appointment::PAYMENT_STATUS_PAID,
            ]);

            return redirect()
                ->route('patient.appointments.show', $payment->appointment_id)
                ->with('success', 'Thanh toán thành công!');
        }

        $payment->update([
            'status' => Payment::STATUS_FAILED,
            'vnpay_response' => $request->all(),
        ]);

        $payment->appointment->update([
            'payment_status' => Appointment::PAYMENT_STATUS_PENDING,
        ]);

        return $this->paymentFailed($payment, 'Thanh toán thất bại: ' . ($request->vnp_Message ?? $request->vnp_ResponseCode));
    }

    protected function buildHashData(array $inputData): string
    {
        $hashData = '';
        foreach ($inputData as $key => $value) {
            $hashData .= ($hashData ? '&' : '') . urlencode($key) . '=' . urlencode($value);
        }

        return $hashData;
    }

    protected function paymentFailed(?Payment $payment, string $message)
    {
        $route = $payment
            ? route('patient.appointments.show', $payment->appointment_id)
            : route('patient.history');

        return redirect($route)->withErrors(['error' => $message]);
    }
}
