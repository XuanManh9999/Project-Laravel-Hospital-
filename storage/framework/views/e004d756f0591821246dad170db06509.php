

<?php $__env->startSection('title', 'Quản lý Tài khoản'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Quản lý Tài khoản</h2>
    <a href="<?php echo e(route('admin.users.create')); ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tạo tài khoản
    </a>
</div>

    <div class="card">
    <div class="card-body">
        <form method="GET" class="mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm tên, email, SĐT..." value="<?php echo e(request('search')); ?>">
                </div>
                <div class="col-md-2">
                    <select name="role" class="form-select">
                        <option value="">Tất cả vai trò</option>
                        <option value="admin" <?php echo e(request('role') == 'admin' ? 'selected' : ''); ?>>Admin</option>
                        <option value="doctor" <?php echo e(request('role') == 'doctor' ? 'selected' : ''); ?>>Bác sĩ</option>
                        <option value="receptionist" <?php echo e(request('role') == 'receptionist' ? 'selected' : ''); ?>>Tiếp viên</option>
                        <option value="patient" <?php echo e(request('role') == 'patient' ? 'selected' : ''); ?>>Bệnh nhân</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">Tất cả trạng thái</option>
                        <option value="active" <?php echo e(request('status') == 'active' ? 'selected' : ''); ?>>Hoạt động</option>
                        <option value="inactive" <?php echo e(request('status') == 'inactive' ? 'selected' : ''); ?>>Khóa</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Tìm kiếm
                    </button>
                </div>
                <div class="col-md-3 text-end">
                    <?php if(request()->hasAny(['search', 'role', 'status'])): ?>
                        <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle"></i> Xóa bộ lọc
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
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Vai trò</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($user->id); ?></td>
                            <td><?php echo e($user->name); ?></td>
                            <td><?php echo e($user->email); ?></td>
                            <td>
                                <span class="badge bg-info">
                                    <?php if($user->role == 'admin'): ?> Admin
                                    <?php elseif($user->role == 'doctor'): ?> Bác sĩ
                                    <?php elseif($user->role == 'receptionist'): ?> Tiếp viên
                                    <?php else: ?> Bệnh nhân
                                    <?php endif; ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-<?php echo e($user->status == 'active' ? 'success' : 'danger'); ?>">
                                    <?php echo e($user->status == 'active' ? 'Hoạt động' : 'Khóa'); ?>

                                </span>
                            </td>
                            <td>
                                <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <?php if($user->role == 'patient'): ?>
                                    <form action="<?php echo e(route('admin.users.destroy', $user->id)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center">Không có dữ liệu</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php echo e($users->links()); ?>

    </div>
</div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\DACN\WEBSITE_BENH_VIEN\resources\views/admin/users/index.blade.php ENDPATH**/ ?>