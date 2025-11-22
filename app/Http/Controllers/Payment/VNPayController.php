<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VNPayController extends Controller
{
    public function createPayment(Request $request, $appointmentId)
    {
        $appointment = Appointment::where('patient_id', auth()->id())
            ->findOrFail($appointmentId);

        if ($appointment->payment_status === Payment::STATUS_SUCCESS) {
            return back()->withErrors(['error' => 'Lịch hẹn này đã được thanh toán.']);
        }

        $vnp_TmnCode = config('services.vnpay.tmn_code');
        $vnp_HashSecret = config('services.vnpay.hash_secret');
        $vnp_Url = config('services.vnpay.url');
        $vnp_ReturnUrl = config('services.vnpay.return_url');

        $vnp_TxnRef = 'APPT' . $appointment->id . '_' . time();
        $vnp_OrderInfo = 'Thanh toan lich hen #' . $appointment->id;
        $vnp_OrderType = 'other';
        $vnp_Amount = $appointment->service->price * 100; // VNPay uses cents
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $request->ip();

        $inputData = array(
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
        );

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        // Create payment record
        Payment::create([
            'appointment_id' => $appointment->id,
            'amount' => $appointment->service->price,
            'payment_method' => 'vnpay',
            'transaction_id' => $vnp_TxnRef,
            'status' => Payment::STATUS_PENDING,
        ]);

        return redirect($vnp_Url);
    }

    public function return(Request $request)
    {
        $vnp_HashSecret = config('services.vnpay.hash_secret');
        $vnp_SecureHash = $request->vnp_SecureHash;

        $inputData = array();
        foreach ($request->all() as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash == $vnp_SecureHash) {
            if ($request->vnp_ResponseCode == '00') {
                $transactionId = $request->vnp_TxnRef;
                $payment = Payment::where('transaction_id', $transactionId)->first();

                if ($payment) {
                    $payment->update([
                        'status' => Payment::STATUS_SUCCESS,
                        'vnpay_response' => $request->all(),
                    ]);

                    $payment->appointment->update([
                        'payment_status' => Appointment::PAYMENT_STATUS_PAID,
                    ]);

                    return redirect()->route('patient.appointments.show', $payment->appointment_id)
                        ->with('success', 'Thanh toán thành công!');
                }
            } else {
                return redirect()->route('patient.dashboard')
                    ->withErrors(['error' => 'Thanh toán thất bại: ' . $request->vnp_ResponseCode]);
            }
        } else {
            return redirect()->route('patient.dashboard')
                ->withErrors(['error' => 'Chữ ký không hợp lệ']);
        }
    }
}

