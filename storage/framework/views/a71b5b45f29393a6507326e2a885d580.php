

<?php $__env->startSection('title', 'Chi tiết lịch hẹn'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Chi tiết Lịch hẹn #<?php echo e($appointment->id); ?></h2>
        <a href="<?php echo e(route('doctor.appointments.index')); ?>" class="btn btn-secondary">Quay lại</a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Bệnh nhân:</strong> <?php echo e($appointment->patient->name); ?></p>
                    <p><strong>Email:</strong> <?php echo e($appointment->patient->email); ?></p>
                    <p><strong>Dịch vụ:</strong> <?php echo e($appointment->service->name); ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Ngày hẹn:</strong> <?php echo e($appointment->appointment_date->format('d/m/Y')); ?></p>
                    <p><strong>Ca khám:</strong> <?php echo e($appointment->shift_label); ?></p>
                    <p><strong>Trạng thái:</strong>
                        <span class="badge bg-<?php echo e($appointment->status == 'accepted' ? 'success' : ($appointment->status == 'waiting_examination' ? 'info' : ($appointment->status == 'rejected' ? 'danger' : ($appointment->status == 'completed' ? 'primary' : ($appointment->status == 'cancelled' ? 'secondary' : 'warning'))))); ?>">
                            <?php if($appointment->status == 'pending'): ?> Chờ xử lý
                            <?php elseif($appointment->status == 'accepted'): ?> Đã chấp nhận
                            <?php elseif($appointment->status == 'waiting_examination'): ?> Chờ khám
                            <?php elseif($appointment->status == 'rejected'): ?> Đã từ chối
                            <?php elseif($appointment->status == 'cancelled'): ?> Đã hủy
                            <?php elseif($appointment->status == 'completed'): ?> Hoàn thành
                            <?php else: ?> <?php echo e($appointment->status); ?>

                            <?php endif; ?>
                        </span>
                    </p>
                    <p><strong>Thanh toán:</strong>
                        <span class="badge bg-<?php echo e($appointment->payment_status === 'paid' ? 'success' : 'secondary'); ?>">
                            <?php if($appointment->payment_status === 'paid'): ?>
                                Đã thanh toán
                            <?php elseif($appointment->payment_status === 'refunded'): ?>
                                Đã hoàn tiền
                            <?php else: ?>
                                Chưa thanh toán
                            <?php endif; ?>
                        </span>
                    </p>
                </div>
            </div>
            <?php if($appointment->notes): ?>
                <hr>
                <p><strong>Ghi chú của bệnh nhân:</strong></p>
                <p class="mb-0"><?php echo e($appointment->notes); ?></p>
            <?php endif; ?>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="mb-3">Thao tác</h5>
            <?php if($appointment->status === \App\Models\Appointment::STATUS_PENDING): ?>
                <form action="<?php echo e(route('doctor.appointments.accept', $appointment->id)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check"></i> Chấp nhận
                    </button>
                </form>
                <form action="<?php echo e(route('doctor.appointments.reject', $appointment->id)); ?>" method="POST" class="d-inline ms-2">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-x"></i> Từ chối
                    </button>
                </form>
            <?php elseif($appointment->status === \App\Models\Appointment::STATUS_ACCEPTED): ?>
                <form action="<?php echo e(route('doctor.appointments.complete', $appointment->id)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check2-circle"></i> Hoàn tất
                    </button>
                </form>
                <?php if($appointment->appointment_date->isToday() || $appointment->appointment_date->isPast()): ?>
                    <form action="<?php echo e(route('doctor.appointments.start-examination', $appointment->id)); ?>" method="POST" class="d-inline ms-2">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-info">
                            <i class="bi bi-clock"></i> Chờ khám
                        </button>
                    </form>
                <?php endif; ?>
            <?php elseif($appointment->status === \App\Models\Appointment::STATUS_WAITING_EXAMINATION): ?>
                <form action="<?php echo e(route('doctor.appointments.complete', $appointment->id)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check2-circle"></i> Hoàn tất
                    </button>
                </form>
            <?php else: ?>
                <p class="text-muted mb-0">Lịch hẹn đã ở trạng thái cuối, không còn thao tác nào.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\DACN\WEBSITE_BENH_VIEN\resources\views/doctor/appointments/show.blade.php ENDPATH**/ ?>