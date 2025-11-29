

<?php $__env->startSection('title', 'Chi tiết lịch hẹn'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Chi tiết Lịch hẹn #<?php echo e($appointment->id); ?></h2>
        <a href="<?php echo e(route('receptionist.appointments.index')); ?>" class="btn btn-secondary">Quay lại</a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-3">Thông tin Bệnh nhân</h5>
                    <p><strong>Họ và tên:</strong> <?php echo e($appointment->patient->name); ?></p>
                    <p><strong>Email:</strong> <?php echo e($appointment->patient->email); ?></p>
                    <?php if($appointment->patient->phone): ?>
                        <p><strong>Số điện thoại:</strong> <?php echo e($appointment->patient->phone); ?></p>
                    <?php endif; ?>
                    <?php if($appointment->patient->address): ?>
                        <p><strong>Địa chỉ:</strong> <?php echo e($appointment->patient->address); ?></p>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <h5 class="mb-3">Thông tin Bác sĩ</h5>
                    <p><strong>Họ và tên:</strong> <?php echo e($appointment->doctor->user->name); ?></p>
                    <p><strong>Chuyên khoa:</strong> <?php echo e($appointment->doctor->specialization); ?></p>
                    <?php if($appointment->doctor->user->phone): ?>
                        <p><strong>Số điện thoại:</strong> <?php echo e($appointment->doctor->user->phone); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-3">Thông tin Lịch hẹn</h5>
                    <p><strong>Dịch vụ:</strong> <?php echo e($appointment->service->name); ?></p>
                    <p><strong>Ngày hẹn:</strong> <?php echo e($appointment->appointment_date->format('d/m/Y')); ?></p>
                    <p><strong>Ca khám:</strong> <?php echo e($appointment->shift_label); ?></p>
                </div>
                <div class="col-md-6">
                    <h5 class="mb-3">Trạng thái</h5>
                    <p><strong>Trạng thái lịch hẹn:</strong>
                        <span class="badge bg-<?php echo e($appointment->status == 'accepted' ? 'success' : ($appointment->status == 'waiting_examination' ? 'info' : ($appointment->status == 'rejected' ? 'danger' : ($appointment->status == 'completed' ? 'primary' : ($appointment->status == 'cancelled' ? 'secondary' : 'warning'))))); ?>">
                            <?php if($appointment->status == 'pending'): ?> Chờ xử lý
                            <?php elseif($appointment->status == 'accepted'): ?> Đã chấp nhận
                            <?php elseif($appointment->status == 'waiting_examination'): ?> Chờ khám
                            <?php elseif($appointment->status == 'rejected'): ?> Đã từ chối
                            <?php elseif($appointment->status == 'completed'): ?> Hoàn thành
                            <?php elseif($appointment->status == 'cancelled'): ?> Đã hủy
                            <?php else: ?> <?php echo e($appointment->status); ?>

                            <?php endif; ?>
                        </span>
                    </p>
                    <p><strong>Trạng thái thanh toán:</strong>
                        <span class="badge bg-<?php echo e($appointment->payment_status === 'paid' ? 'success' : ($appointment->payment_status === 'refunded' ? 'info' : 'secondary')); ?>">
                            <?php if($appointment->payment_status === 'paid'): ?>
                                Đã thanh toán
                            <?php elseif($appointment->payment_status === 'refunded'): ?>
                                Đã hoàn tiền
                            <?php else: ?>
                                Chưa thanh toán
                            <?php endif; ?>
                        </span>
                    </p>
                    <?php if($appointment->payment): ?>
                        <p><strong>Số tiền:</strong> <?php echo e(number_format($appointment->payment->amount, 0, ',', '.')); ?> đ</p>
                        <p><strong>Ngày thanh toán:</strong> <?php echo e($appointment->payment->created_at->format('d/m/Y H:i')); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php if($appointment->notes): ?>
                <hr>
                <h5 class="mb-3">Ghi chú</h5>
                <p class="mb-0"><?php echo e($appointment->notes); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\DACN\WEBSITE_BENH_VIEN\resources\views/receptionist/appointments/show.blade.php ENDPATH**/ ?>