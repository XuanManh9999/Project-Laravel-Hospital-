<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Thông báo hủy lịch hẹn và hoàn tiền</title>
</head>
<body>
    <h2>Thông báo hủy lịch hẹn và hoàn tiền</h2>
    
    <p>Xin chào {{ $appointment->patient->name }},</p>
    
    <p>Lịch hẹn của bạn đã được <strong>hủy</strong>. Vì lịch hẹn này đã được thanh toán, bạn có thể yêu cầu hoàn tiền.</p>
    
    <p><strong>Chi tiết lịch hẹn đã hủy:</strong></p>
    <ul>
        <li>Bác sĩ: {{ $appointment->doctor->user->name }}</li>
        <li>Dịch vụ: {{ $appointment->service->name }}</li>
        <li>Ngày: {{ $appointment->appointment_date->format('d/m/Y') }}</li>
        <li>Ca khám: {{ $appointment->shift_label }}</li>
        @if($appointment->payment)
            <li>Số tiền đã thanh toán: {{ number_format($appointment->payment->amount, 0, ',', '.') }} đ</li>
        @endif
    </ul>
    
    <p><strong>Để nhận được hoàn tiền, vui lòng liên hệ qua Zalo:</strong></p>
    <p style="font-size: 18px; color: #0068FF; font-weight: bold;">
        Zalo: {{ config('app.zalo_contact', '09xxxxx') }}
    </p>
    <p>Vui lòng cung cấp mã lịch hẹn: <strong>#{{ $appointment->id }}</strong> khi liên hệ.</p>
    
    <p>Trân trọng,<br>Hệ thống Quản lý Bệnh viện</p>
</body>
</html>

