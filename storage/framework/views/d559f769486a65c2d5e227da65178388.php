

<?php $__env->startSection('title', 'Lịch sử Lịch hẹn'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4 px-3 px-md-4">
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                            <i class="bi bi-person-circle display-4 text-primary"></i>
                        </div>
                    </div>
                    <h5 class="mb-1"><?php echo e(auth()->user()->name); ?></h5>
                    <p class="text-muted small mb-0"><?php echo e(auth()->user()->email); ?></p>
                    <span class="badge bg-primary mt-2">Bệnh nhân</span>
                </div>
            </div>

            <div class="card border-0 shadow-sm mt-3">
                <div class="list-group list-group-flush">
                    <a href="<?php echo e(route('patient.profile')); ?>" class="list-group-item list-group-item-action">
                        <i class="bi bi-person me-2"></i> Thông tin cá nhân
                    </a>
                    <a href="<?php echo e(route('patient.profile')); ?>#change-password" class="list-group-item list-group-item-action">
                        <i class="bi bi-key me-2"></i> Đổi mật khẩu
                    </a>
                    <a href="<?php echo e(route('patient.history')); ?>" class="list-group-item list-group-item-action active">
                        <i class="bi bi-calendar-check me-2"></i> Lịch khám của tôi
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Lịch sử Lịch hẹn</h2>
                <a href="<?php echo e(route('patient.doctors.index')); ?>" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Đặt lịch mới
                </a>
            </div>

            <div class="card border-0 shadow-sm">
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
                                            <div class="d-flex flex-wrap gap-2">
                                                <a href="<?php echo e(route('patient.appointments.show', $appointment->id)); ?>" class="btn btn-sm btn-primary">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </div>
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
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\DACN\WEBSITE_BENH_VIEN\resources\views/patient/history.blade.php ENDPATH**/ ?>