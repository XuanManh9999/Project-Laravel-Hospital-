<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Thông báo lịch hẹn</title>
</head>
<body>
    <h2>Thông báo lịch hẹn</h2>
    
    <p>Xin chào <?php echo e($appointment->patient->name); ?>,</p>
    
    <?php if($action == 'accepted'): ?>
        <p>Lịch hẹn của bạn đã được <strong>chấp nhận</strong> bởi bác sĩ <?php echo e($doctor->name); ?>.</p>
    <?php else: ?>
        <p>Lịch hẹn của bạn đã bị <strong>từ chối</strong> bởi bác sĩ <?php echo e($doctor->name); ?>.</p>
    <?php endif; ?>
    
    <p><strong>Chi tiết lịch hẹn:</strong></p>
    <ul>
        <li>Bác sĩ: <?php echo e($doctor->name); ?></li>
        <li>Dịch vụ: <?php echo e($appointment->service->name); ?></li>
        <li>Ngày: <?php echo e($appointment->appointment_date->format('d/m/Y')); ?></li>
        <li>Ca khám: <?php echo e($appointment->shift_label); ?></li>
    </ul>
    
    <p>Trân trọng,<br>Hệ thống Quản lý Bệnh viện</p>
</body>
</html>

<?php /**PATH D:\workspace\DACN\WEBSITE_BENH_VIEN\resources\views/emails/appointment-notification.blade.php ENDPATH**/ ?>