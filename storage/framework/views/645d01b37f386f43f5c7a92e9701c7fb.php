

<?php $__env->startSection('title', 'Quản lý Lịch hẹn'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Quản lý Lịch hẹn</h2>
    </div>

    <div class="card">
    <div class="card-body">
        <form method="GET" class="mb-4">
            <div class="row g-3">
                <div class="col-md-2">
                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm..." value="<?php echo e(request('search')); ?>">
                </div>
                <div class="col-md-2">
                    <input type="date" name="date" class="form-control" value="<?php echo e(request('date')); ?>" placeholder="Ngày hẹn">
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">Tất cả trạng thái</option>
                        <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Chờ xử lý</option>
                        <option value="accepted" <?php echo e(request('status') == 'accepted' ? 'selected' : ''); ?>>Đã chấp nhận</option>
                        <option value="rejected" <?php echo e(request('status') == 'rejected' ? 'selected' : ''); ?>>Đã từ chối</option>
                        <option value="cancelled" <?php echo e(request('status') == 'cancelled' ? 'selected' : ''); ?>>Đã hủy</option>
                        <option value="completed" <?php echo e(request('status') == 'completed' ? 'selected' : ''); ?>>Hoàn thành</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="payment_status" class="form-select">
                        <option value="">Tất cả thanh toán</option>
                        <option value="paid" <?php echo e(request('payment_status') == 'paid' ? 'selected' : ''); ?>>Đã thanh toán</option>
                        <option value="unpaid" <?php echo e(request('payment_status') == 'unpaid' ? 'selected' : ''); ?>>Chưa thanh toán</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="doctor_id" class="form-select">
                        <option value="">Tất cả bác sĩ</option>
                        <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($doctor->id); ?>" <?php echo e(request('doctor_id') == $doctor->id ? 'selected' : ''); ?>>
                                <?php echo e($doctor->user->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
                <div class="col-md-1">
                    <?php if(request()->hasAny(['search', 'date', 'status', 'payment_status', 'doctor_id'])): ?>
                        <a href="<?php echo e(route('admin.appointments.index')); ?>" class="btn btn-outline-secondary w-100" title="Xóa bộ lọc">
                            <i class="bi bi-x-circle"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Bệnh nhân</th>
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
                            <td><?php echo e($appointment->id); ?></td>
                            <td><?php echo e($appointment->patient->name); ?></td>
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
                                <?php if($appointment->status == 'pending'): ?>
                                    <form action="<?php echo e(route('admin.appointments.accept', $appointment->id)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="bi bi-check"></i>
                                        </button>
                                    </form>
                                    <form action="<?php echo e(route('admin.appointments.reject', $appointment->id)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </form>
                                <?php endif; ?>
                                <form action="<?php echo e(route('admin.appointments.destroy', $appointment->id)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="text-center">Không có dữ liệu</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($appointments->hasPages()): ?>
            <div class="mt-4">
                <?php echo e($appointments->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\DACN\WEBSITE_BENH_VIEN\resources\views/admin/appointments/index.blade.php ENDPATH**/ ?>