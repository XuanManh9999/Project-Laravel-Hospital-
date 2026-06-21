

<?php $__env->startSection('title', 'Dashboard Bệnh nhân'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Dashboard</h2>
        <a href="<?php echo e(route('patient.doctors.index')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Đặt lịch hẹn
        </a>
    </div>

    <div class="card mb-4">
    <div class="card-header">
        <h5>Lịch hẹn sắp tới</h5>
    </div>
    <div class="card-body">
        <?php if($upcomingAppointments->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Bác sĩ</th>
                            <th>Dịch vụ</th>
                            <th>Ngày giờ</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $upcomingAppointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($appointment->doctor->user->name); ?></td>
                                <td><?php echo e($appointment->service->name); ?></td>
                                <td><?php echo e($appointment->appointment_date->format('d/m/Y')); ?> - <?php echo e($appointment->shift_label); ?></td>
                                <td>
                                    <span class="badge bg-success">Đã chấp nhận</span>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('patient.appointments.show', $appointment->id)); ?>" class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-muted">Bạn chưa có lịch hẹn nào.</p>
        <?php endif; ?>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\DACN\WEBSITE_BENH_VIEN\resources\views/patient/dashboard.blade.php ENDPATH**/ ?>