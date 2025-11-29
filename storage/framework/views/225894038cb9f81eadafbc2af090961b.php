

<?php $__env->startSection('title', 'Lịch hẹn'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Lịch hẹn phòng khám</h2>
    </div>

        <div class="card">
        <div class="card-body">
        <form method="GET" class="mb-3">
            <div class="row g-3">
                <div class="col-md-3">
                    <input type="date" name="date" class="form-control" value="<?php echo e(request('date')); ?>">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">Tất cả trạng thái</option>
                        <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Chờ xử lý</option>
                        <option value="accepted" <?php echo e(request('status') == 'accepted' ? 'selected' : ''); ?>>Đã chấp nhận</option>
                        <option value="waiting_examination" <?php echo e(request('status') == 'waiting_examination' ? 'selected' : ''); ?>>Chờ khám</option>
                        <option value="completed" <?php echo e(request('status') == 'completed' ? 'selected' : ''); ?>>Hoàn thành</option>
                        <option value="rejected" <?php echo e(request('status') == 'rejected' ? 'selected' : ''); ?>>Đã từ chối</option>
                        <option value="cancelled" <?php echo e(request('status') == 'cancelled' ? 'selected' : ''); ?>>Đã hủy</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="text" name="patient_name" class="form-control" placeholder="Tìm theo tên bệnh nhân" value="<?php echo e(request('patient_name')); ?>">
                </div>
                <div class="col-md-3">
                    <input type="text" name="doctor_name" class="form-control" placeholder="Tìm theo tên bác sĩ" value="<?php echo e(request('doctor_name')); ?>">
                </div>
            </div>
            <div class="row g-3 mt-2">
                <div class="col-md-2 ms-auto">
                    <button type="submit" class="btn btn-primary w-100">Lọc</button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
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
                                <span class="badge bg-<?php echo e($appointment->payment_status === 'paid' ? 'success' : ($appointment->payment_status === 'refunded' ? 'info' : 'secondary')); ?>">
                                    <?php if($appointment->payment_status === 'paid'): ?>
                                        Đã thanh toán
                                    <?php elseif($appointment->payment_status === 'refunded'): ?>
                                        Đã hoàn tiền
                                    <?php else: ?>
                                        Chưa thanh toán
                                    <?php endif; ?>
                                </span>
                            </td>
                            <td>
                                <a href="<?php echo e(route('receptionist.appointments.show', $appointment->id)); ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> Xem chi tiết
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
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\DACN\WEBSITE_BENH_VIEN\resources\views/receptionist/appointments/index.blade.php ENDPATH**/ ?>