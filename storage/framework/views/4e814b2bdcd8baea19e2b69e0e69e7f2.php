

<?php $__env->startSection('title', 'Sửa tài khoản'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Sửa tài khoản</h2>
    <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-secondary">Quay lại</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="<?php echo e(route('admin.users.update', $user->id)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Họ và tên</label>
                    <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           name="name" value="<?php echo e(old('name', $user->name)); ?>" required>
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           name="email" value="<?php echo e(old('email', $user->email)); ?>" required>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Mật khẩu mới (để trống nếu không đổi)</label>
                    <input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           name="password">
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" name="phone" value="<?php echo e(old('phone', $user->phone)); ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" name="address" value="<?php echo e(old('address', $user->address)); ?>">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="status" class="form-select" required>
                        <option value="active" <?php echo e(old('status', $user->status) == 'active' ? 'selected' : ''); ?>>Hoạt động</option>
                        <option value="inactive" <?php echo e(old('status', $user->status) == 'inactive' ? 'selected' : ''); ?>>Khóa</option>
                    </select>
                </div>
            </div>

            <?php if($user->role === 'doctor' && $user->doctor): ?>
                <hr class="my-4">
                <h5 class="mb-3">Thông tin Bác sĩ</h5>
                
                <div class="mb-3">
                    <label class="form-label">Avatar (URL)</label>
                    <input type="url" class="form-control" name="avatar" value="<?php echo e(old('avatar', $user->doctor->avatar)); ?>" placeholder="https://example.com/avatar.jpg">
                    <small class="form-text text-muted">Nhập URL hình ảnh avatar từ internet</small>
                    <?php if($user->doctor->avatar): ?>
                        <div class="mt-2">
                            <img src="<?php echo e($user->doctor->avatar); ?>" alt="Current avatar" class="img-thumbnail" style="max-height: 150px; max-width: 150px; object-fit: cover; border-radius: 50%;" onerror="this.style.display='none'">
                        </div>
                    <?php endif; ?>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Chuyên khoa</label>
                        <input type="text" class="form-control" name="specialization" value="<?php echo e(old('specialization', $user->doctor->specialization)); ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kinh nghiệm (năm)</label>
                        <input type="number" class="form-control" name="experience" value="<?php echo e(old('experience', $user->doctor->experience)); ?>" min="0">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Bằng cấp</label>
                        <input type="text" class="form-control" name="qualification" value="<?php echo e(old('qualification', $user->doctor->qualification)); ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phí tư vấn</label>
                        <input type="number" class="form-control" name="consultation_fee" value="<?php echo e(old('consultation_fee', $user->doctor->consultation_fee)); ?>" min="0" step="0.01">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Giới thiệu</label>
                    <textarea class="form-control" name="bio" rows="3"><?php echo e(old('bio', $user->doctor->bio)); ?></textarea>
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\DACN\WEBSITE_BENH_VIEN\resources\views/admin/users/edit.blade.php ENDPATH**/ ?>