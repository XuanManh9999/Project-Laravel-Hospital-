

<?php $__env->startSection('title', 'Chi tiết Lịch hẹn'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Chi tiết Lịch hẹn #<?php echo e($appointment->id); ?></h2>
        <a href="<?php echo e(route('patient.history')); ?>" class="btn btn-secondary">Quay lại</a>
    </div>

    <div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Bác sĩ:</strong> <?php echo e($appointment->doctor->user->name); ?></p>
                <p><strong>Dịch vụ:</strong> <?php echo e($appointment->service->name); ?></p>
                <p><strong>Ngày hẹn:</strong> <?php echo e($appointment->appointment_date->format('d/m/Y')); ?></p>
                <p><strong>Ca khám:</strong> <?php echo e($appointment->shift_label); ?></p>
            </div>
            <div class="col-md-6">
                <p><strong>Trạng thái:</strong> 
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
                <p><strong>Thanh toán:</strong> 
                    <span class="badge bg-<?php echo e($appointment->payment_status == 'paid' ? 'success' : 'secondary'); ?>">
                        <?php echo e($appointment->payment_status == 'paid' ? 'Đã thanh toán' : 'Chưa thanh toán'); ?>

                    </span>
                </p>
                <?php if($appointment->notes): ?>
                    <p><strong>Ghi chú:</strong> <?php echo e($appointment->notes); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <?php if($appointment->payment_status !== \App\Models\Appointment::PAYMENT_STATUS_PAID && in_array($appointment->status, ['pending','accepted'])): ?>
            <form method="POST" action="<?php echo e(route('vnpay.create', $appointment->id)); ?>" class="d-inline">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-credit-card"></i> Thanh toán VNPay
                </button>
            </form>
            <div class="alert alert-info mt-3 mb-0">
                <small>
                    Bạn sẽ được chuyển hướng tới cổng VNPay để hoàn tất thanh toán.
                    Sau khi thanh toán thành công, trạng thái sẽ được cập nhật tự động.
                </small>
            </div>
        <?php endif; ?>

        <?php if(in_array($appointment->status, ['pending','accepted'])): ?>
            <?php if($appointment->canBeCancelled()): ?>
                <form method="POST" action="<?php echo e(route('patient.appointments.cancel', $appointment->id)); ?>" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn hủy lịch hẹn này?')">
                        <i class="bi bi-x-circle"></i> Hủy lịch hẹn
                    </button>
                </form>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\DACN\WEBSITE_BENH_VIEN\resources\views/patient/appointments/show.blade.php ENDPATH**/ ?>