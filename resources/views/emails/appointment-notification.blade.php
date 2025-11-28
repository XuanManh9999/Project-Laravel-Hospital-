<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Thông báo lịch hẹn</title>
</head>
<body>
    <h2>Thông báo lịch hẹn</h2>
    
    <p>Xin chào {{ $appointment->patient->name }},</p>
    
    @if($action == 'accepted')
        <p>Lịch hẹn của bạn đã được <strong>chấp nhận</strong> bởi bác sĩ {{ $doctor->name }}.</p>
    @else
        <p>Lịch hẹn của bạn đã bị <strong>từ chối</strong> bởi bác sĩ {{ $doctor->name }}.</p>
    @endif
    
    <p><strong>Chi tiết lịch hẹn:</strong></p>
    <ul>
        <li>Bác sĩ: {{ $doctor->name }}</li>
        <li>Dịch vụ: {{ $appointment->service->name }}</li>
        <li>Ngày: {{ $appointment->appointment_date->format('d/m/Y') }}</li>
        <li>Ca khám: {{ $appointment->shift_label }}</li>
    </ul>
    
    <p>Trân trọng,<br>Hệ thống Quản lý Bệnh viện</p>
</body>
</html>

