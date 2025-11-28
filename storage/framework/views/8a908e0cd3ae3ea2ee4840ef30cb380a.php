

<?php $__env->startSection('title', 'Quản lý Hoàn tiền'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Quản lý Hoàn tiền</h2>
    </div>

    <div class="card">
    <div class="card-body">
        <form method="GET" class="mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm bệnh nhân, lý do..." value="<?php echo e(request('search')); ?>">
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">Tất cả trạng thái</option>
                        <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Chờ xử lý</option>
                        <option value="processed" <?php echo e(request('status') == 'processed' ? 'selected' : ''); ?>>Đã xử lý</option>
                        <option value="rejected" <?php echo e(request('status') == 'rejected' ? 'selected' : ''); ?>>Đã từ chối</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="date" name="date_from" class="form-control" value="<?php echo e(request('date_from')); ?>" placeholder="Từ ngày">
                </div>
                <div class="col-md-2">
                    <input type="date" name="date_to" class="form-control" value="<?php echo e(request('date_to')); ?>" placeholder="Đến ngày">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Tìm kiếm
                    </button>
                </div>
                <div class="col-md-1">
                    <?php if(request()->hasAny(['search', 'status', 'date_from', 'date_to'])): ?>
                        <a href="<?php echo e(route('admin.refunds.index')); ?>" class="btn btn-outline-secondary w-100" title="Xóa bộ lọc">
                            <i class="bi bi-x-circle"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </form>

        <form method="POST" action="<?php echo e(route('admin.refunds.bulk-action')); ?>">
            <?php echo csrf_field(); ?>
            <div class="row g-3 mb-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label mb-1">Thao tác hàng loạt</label>
                    <select name="action" class="form-select" required>
                        <option value="">-- Chọn thao tác --</option>
                        <option value="process">Xử lý hoàn tiền</option>
                        <option value="reject">Từ chối hoàn tiền</option>
                    </select>
                </div>
                <div class="col-md-5">
                    <label class="form-label mb-1">Lý do (khi từ chối)</label>
                    <input type="text" name="reason_bulk" class="form-control" placeholder="Lý do từ chối (tùy chọn)">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="bi bi-play-circle"></i> Thực hiện
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="select-all-refunds">
                            </th>
                            <th>ID</th>
                            <th>Lịch hẹn</th>
                            <th>Bệnh nhân</th>
                            <th>Số tiền</th>
                            <th>Lý do</th>
                            <th>Trạng thái</th>
                            <th>Người xử lý</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $refunds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $refund): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <?php if($refund->status == 'pending'): ?>
                                        <input type="checkbox" name="ids[]" value="<?php echo e($refund->id); ?>" class="refund-checkbox">
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($refund->id); ?></td>
                                <td>#<?php echo e($refund->appointment->id); ?></td>
                                <td><?php echo e($refund->appointment->patient->name); ?></td>
                                <td><?php echo e(number_format($refund->amount, 0, ',', '.')); ?> đ</td>
                                <td><?php echo e(Str::limit($refund->reason, 50)); ?></td>
                                <td>
                                    <span class="badge bg-<?php echo e($refund->status == 'processed' ? 'success' : ($refund->status == 'rejected' ? 'danger' : 'warning')); ?>">
                                        <?php if($refund->status == 'pending'): ?> Chờ xử lý
                                        <?php elseif($refund->status == 'processed'): ?> Đã xử lý
                                        <?php else: ?> Đã từ chối
                                        <?php endif; ?>
                                    </span>
                                </td>
                                <td><?php echo e($refund->processor ? $refund->processor->name : '-'); ?></td>
                                <td>
                                    <?php if($refund->status == 'pending'): ?>
                                        <form action="<?php echo e(route('admin.refunds.process', $refund->id)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <i class="bi bi-check"></i> Xử lý
                                            </button>
                                        </form>
                                        <form action="<?php echo e(route('admin.refunds.reject', $refund->id)); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-x"></i> Từ chối
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="9" class="text-center">Không có dữ liệu</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </form>

        <?php if($refunds->hasPages()): ?>
            <div class="mt-4">
                <?php echo e($refunds->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</div>
</div>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectAll = document.getElementById('select-all-refunds');
            if (!selectAll) return;

            const checkboxes = document.querySelectorAll('.refund-checkbox');

            selectAll.addEventListener('change', function () {
                checkboxes.forEach(cb => cb.checked = selectAll.checked);
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\DACN\WEBSITE_BENH_VIEN\resources\views/admin/refunds/index.blade.php ENDPATH**/ ?>