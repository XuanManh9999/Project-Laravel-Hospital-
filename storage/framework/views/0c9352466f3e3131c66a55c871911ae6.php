

<?php $__env->startSection('title', 'Đăng ký'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <i class="bi bi-person-plus display-1 text-primary"></i>
                        </div>
                        <h2 class="fw-bold mb-2">Đăng ký tài khoản</h2>
                        <p class="text-muted">Tạo tài khoản bệnh nhân mới</p>
                    </div>

                    <form method="POST" action="<?php echo e(route('register')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-semibold">
                                    <i class="bi bi-person"></i> Họ và tên <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       id="name" 
                                       name="name" 
                                       value="<?php echo e(old('name')); ?>" 
                                       placeholder="Nhập họ và tên"
                                       required>
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
                                <label for="email" class="form-label fw-semibold">
                                    <i class="bi bi-envelope"></i> Email <span class="text-danger">*</span>
                                </label>
                                <input type="email" 
                                       class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       id="email" 
                                       name="email" 
                                       value="<?php echo e(old('email')); ?>" 
                                       placeholder="example@email.com"
                                       required>
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
                                <label for="password" class="form-label fw-semibold">
                                    <i class="bi bi-lock"></i> Mật khẩu <span class="text-danger">*</span>
                                </label>
                                <input type="password" 
                                       class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       id="password" 
                                       name="password" 
                                       placeholder="Tối thiểu 8 ký tự"
                                       required>
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
                                <label for="password_confirmation" class="form-label fw-semibold">
                                    <i class="bi bi-lock-fill"></i> Xác nhận mật khẩu <span class="text-danger">*</span>
                                </label>
                                <input type="password" 
                                       class="form-control" 
                                       id="password_confirmation" 
                                       name="password_confirmation" 
                                       placeholder="Nhập lại mật khẩu"
                                       required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label fw-semibold">
                                    <i class="bi bi-telephone"></i> Số điện thoại
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="phone" 
                                       name="phone" 
                                       value="<?php echo e(old('phone')); ?>" 
                                       placeholder="0901234567">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="date_of_birth" class="form-label fw-semibold">
                                    <i class="bi bi-calendar"></i> Ngày sinh
                                </label>
                                <input type="date" 
                                       class="form-control" 
                                       id="date_of_birth" 
                                       name="date_of_birth" 
                                       value="<?php echo e(old('date_of_birth')); ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="gender" class="form-label fw-semibold">
                                    <i class="bi bi-gender-ambiguous"></i> Giới tính
                                </label>
                                <select class="form-select" id="gender" name="gender">
                                    <option value="">Chọn giới tính</option>
                                    <option value="male" <?php echo e(old('gender') == 'male' ? 'selected' : ''); ?>>Nam</option>
                                    <option value="female" <?php echo e(old('gender') == 'female' ? 'selected' : ''); ?>>Nữ</option>
                                    <option value="other" <?php echo e(old('gender') == 'other' ? 'selected' : ''); ?>>Khác</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="address" class="form-label fw-semibold">
                                    <i class="bi bi-geo-alt"></i> Địa chỉ
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="address" 
                                       name="address" 
                                       value="<?php echo e(old('address')); ?>" 
                                       placeholder="Nhập địa chỉ">
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    Tôi đồng ý với <a href="#" class="text-decoration-none">điều khoản sử dụng</a> và <a href="#" class="text-decoration-none">chính sách bảo mật</a>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                            <i class="bi bi-person-plus"></i> Đăng ký
                        </button>

                        <div class="text-center">
                            <p class="mb-0 text-muted">Đã có tài khoản?</p>
                            <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-primary w-100 mt-2">
                                <i class="bi bi-box-arrow-in-right"></i> Đăng nhập ngay
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\DACN\WEBSITE_BENH_VIEN\resources\views/auth/register.blade.php ENDPATH**/ ?>