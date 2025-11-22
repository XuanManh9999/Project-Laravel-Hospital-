<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Thông báo hủy lịch hẹn và hoàn tiền</title>
</head>
<body>
    <h2>Thông báo hủy lịch hẹn và hoàn tiền</h2>
    
    <p>Xin chào {{ $appointment->patient->name }},</p>
    
    <p>Lịch hẹn của bạn đã được hủy. Vì lịch hẹn này đã được thanh toán, bạn có thể yêu cầu hoàn tiền.</p>
    
    <p><strong>Chi tiết lịch hẹn đã hủy:</strong></p>
    <ul>
        <li>Bác sĩ: {{ $appointment->doctor->user->name }}</li>
        <li>Dịch vụ: {{ $appointment->service->name }}</li>
        <li>Ngày: {{ $appointment->appointment_date->format('d/m/Y') }}</li>
        <li>Số tiền: {{ number_format($appointment->payment->amount, 0, ',', '.') }} đ</li>
    </ul>
    
    <p><strong>Để nhận được hoàn tiền, vui lòng liên hệ:</strong></p>
    <p>Zalo: {{ config('app.zalo_contact', '09xxxxx') }}</p>
    
    <p>Trân trọng,<br>Hệ thống Quản lý Bệnh viện</p>
</body>
</html>

