

<?php $__env->startSection('title', 'Lịch sử lịch hẹn'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4 px-3 px-md-4">
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <?php if($doctor->avatar ?? false): ?>
                            <img src="<?php echo e($doctor->avatar); ?>" alt="<?php echo e(auth()->user()->name); ?>"
                                 class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover; border: 3px solid #0d6efd;">
                        <?php else: ?>
                            <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                                <i class="bi bi-person-badge display-4 text-primary"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <h5 class="mb-1"><?php echo e(auth()->user()->name); ?></h5>
                    <p class="text-muted small mb-0"><?php echo e(auth()->user()->email); ?></p>
                    <span class="badge bg-success mt-2">Bác sĩ</span>
                </div>
            </div>

            <div class="card border-0 shadow-sm mt-3">
                <div class="list-group list-group-flush">
                    <a href="<?php echo e(route('doctor.profile')); ?>" class="list-group-item list-group-item-action">
                        <i class="bi bi-person me-2"></i> Thông tin cá nhân
                    </a>
                    <a href="<?php echo e(route('doctor.profile')); ?>#change-password" class="list-group-item list-group-item-action">
                        <i class="bi bi-key me-2"></i> Đổi mật khẩu
                    </a>
                    <a href="<?php echo e(route('doctor.appointments.index')); ?>" class="list-group-item list-group-item-action">
                        <i class="bi bi-calendar-check me-2"></i> Lịch hẹn của tôi
                    </a>
                    <a href="<?php echo e(route('doctor.history')); ?>" class="list-group-item list-group-item-action active">
                        <i class="bi bi-clock-history me-2"></i> Lịch sử lịch hẹn
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="bi bi-clock-history"></i> Lịch sử lịch hẹn
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Bệnh nhân</th>
                                    <th>Dịch vụ</th>
                                    <th>Ngày giờ</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($appointment->patient->name); ?></td>
                                        <td><?php echo e($appointment->service->name); ?></td>
                                        <td><?php echo e($appointment->appointment_date->format('d/m/Y')); ?> - <?php echo e($appointment->shift_label); ?></td>
                                        <td>
                                            <span class="badge bg-<?php echo e($appointment->status == 'completed' ? 'success' : 'secondary'); ?>">
                                                <?php echo e($appointment->status == 'completed' ? 'Hoàn thành' : 'Đã hủy'); ?>

                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Không có dữ liệu</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <?php echo e($appointments->links()); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\DACN\WEBSITE_BENH_VIEN\resources\views/doctor/history.blade.php ENDPATH**/ ?>