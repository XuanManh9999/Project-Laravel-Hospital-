

<?php $__env->startSection('title', 'Đăng nhập'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <i class="bi bi-hospital display-1 text-primary"></i>
                        </div>
                        <h2 class="fw-bold mb-2">Đăng nhập</h2>
                        <p class="text-muted">Hệ thống Quản lý Bệnh viện</p>
                    </div>

                    <?php if(session('status')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo e(session('status')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">
                                <i class="bi bi-envelope"></i> Email
                            </label>
                            <input type="email" 
                                   class="form-control form-control-lg <?php $__errorArgs = ['email'];
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
                                   placeholder="Nhập email của bạn"
                                   required 
                                   autofocus>
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

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">
                                <i class="bi bi-lock"></i> Mật khẩu
                            </label>
                            <input type="password" 
                                   class="form-control form-control-lg <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="password" 
                                   name="password" 
                                   placeholder="Nhập mật khẩu"
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

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">
                                Ghi nhớ đăng nhập
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                            <i class="bi bi-box-arrow-in-right"></i> Đăng nhập
                        </button>

                        <div class="text-center mb-3">
                            <a href="<?php echo e(route('password.request')); ?>" class="text-decoration-none">
                                <i class="bi bi-question-circle"></i> Quên mật khẩu?
                            </a>
                        </div>

                        <hr class="my-4">

                        <div class="text-center">
                            <p class="mb-0 text-muted">Chưa có tài khoản?</p>
                            <a href="<?php echo e(route('register')); ?>" class="btn btn-outline-primary w-100 mt-2">
                                <i class="bi bi-person-plus"></i> Đăng ký ngay
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Demo Accounts Info -->
            <div class="card border-0 shadow-sm mt-3">
                <div class="card-body">
                    <small class="text-muted">
                        <strong>Demo:</strong> admin@hospital.com / password
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\DACN\WEBSITE_BENH_VIEN\resources\views/auth/login.blade.php ENDPATH**/ ?>