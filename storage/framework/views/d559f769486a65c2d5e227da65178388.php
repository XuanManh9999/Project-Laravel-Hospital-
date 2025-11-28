

<?php $__env->startSection('title', 'Lịch sử Lịch hẹn'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Lịch sử Lịch hẹn</h2>
        <a href="<?php echo e(route('patient.doctors.index')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Đặt lịch mới
        </a>
    </div>

    <div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Bác sĩ</th>
                        <th>Dịch vụ</th>
                        <th>Ngày giờ</th>
                        <th>Trạng thái</th>
                        <th>Thanh toán</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>#<?php echo e($appointment->id); ?></td>
                            <td><?php echo e($appointment->doctor->user->name); ?></td>
                            <td><?php echo e($appointment->service->name); ?></td>
                            <td><?php echo e($appointment->appointment_date->format('d/m/Y')); ?> - <?php echo e($appointment->shift_label); ?></td>
                            <td>
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
                            </td>
                            <td>
                                <span class="badge bg-<?php echo e($appointment->payment_status == 'paid' ? 'success' : 'secondary'); ?>">
                                    <?php echo e($appointment->payment_status == 'paid' ? 'Đã thanh toán' : 'Chưa thanh toán'); ?>

                                </span>
                            </td>
                            <td>
                                <a href="<?php echo e(route('patient.appointments.show', $appointment->id)); ?>" class="btn btn-sm btn-primary">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center">Không có dữ liệu</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php echo e($appointments->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\DACN\WEBSITE_BENH_VIEN\resources\views/patient/history.blade.php ENDPATH**/ ?>