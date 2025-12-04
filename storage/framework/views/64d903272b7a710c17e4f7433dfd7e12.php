

<?php $__env->startSection('title', 'Thông tin cá nhân'); ?>

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
                    <a href="#profile-info" class="list-group-item list-group-item-action active" data-bs-toggle="tab">
                        <i class="bi bi-person me-2"></i> Thông tin cá nhân
                    </a>
                    <a href="#change-password" class="list-group-item list-group-item-action" data-bs-toggle="tab">
                        <i class="bi bi-key me-2"></i> Đổi mật khẩu
                    </a>
                    <a href="<?php echo e(route('patient.history')); ?>" class="list-group-item list-group-item-action">
                        <i class="bi bi-calendar-check me-2"></i> Lịch khám của tôi
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h4 class="mb-0">
                        <i class="bi bi-person"></i> Thông tin cá nhân
                    </h4>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <!-- Profile Info Tab -->
                        <div class="tab-pane fade show active" id="profile-info">
                            <form method="POST" action="<?php echo e(route('patient.profile.update')); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-person"></i> Họ và tên <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="name" value="<?php echo e(auth()->user()->name); ?>" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-envelope"></i> Email <span class="text-danger">*</span>
                                        </label>
                                        <input type="email" class="form-control" name="email" value="<?php echo e(auth()->user()->email); ?>" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-telephone"></i> Số điện thoại
                                        </label>
                                        <input type="text" class="form-control" name="phone" value="<?php echo e(auth()->user()->phone); ?>">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-calendar"></i> Ngày sinh
                                        </label>
                                        <input type="date" class="form-control" name="date_of_birth" value="<?php echo e($patient->date_of_birth ? (\Carbon\Carbon::parse($patient->date_of_birth)->format('Y-m-d')) : ''); ?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-gender-ambiguous"></i> Giới tính
                                        </label>
                                        <select name="gender" class="form-select">
                                            <option value="">Chọn giới tính</option>
                                            <option value="male" <?php echo e($patient->gender == 'male' ? 'selected' : ''); ?>>Nam</option>
                                            <option value="female" <?php echo e($patient->gender == 'female' ? 'selected' : ''); ?>>Nữ</option>
                                            <option value="other" <?php echo e($patient->gender == 'other' ? 'selected' : ''); ?>>Khác</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-card-text"></i> Số bảo hiểm
                                        </label>
                                        <input type="text" class="form-control" name="insurance_number" value="<?php echo e($patient->insurance_number); ?>">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-geo-alt"></i> Địa chỉ
                                    </label>
                                    <input type="text" class="form-control" name="address" value="<?php echo e(auth()->user()->address); ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-file-medical"></i> Tiền sử bệnh
                                    </label>
                                    <textarea class="form-control" name="medical_history" rows="4" placeholder="Nhập tiền sử bệnh của bạn..."><?php echo e($patient->medical_history); ?></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Cập nhật thông tin
                                </button>
                            </form>
                        </div>

                        <!-- Change Password Tab -->
                        <div class="tab-pane fade" id="change-password">
                            <form method="POST" action="<?php echo e(route('patient.profile.change-password')); ?>">
                                <?php echo csrf_field(); ?>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-lock"></i> Mật khẩu hiện tại <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" class="form-control <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           name="current_password" required>
                                    <?php $__errorArgs = ['current_password'];
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
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-key"></i> Mật khẩu mới <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           name="password" required>
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
                                    <small class="form-text text-muted">Tối thiểu 8 ký tự</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-key-fill"></i> Xác nhận mật khẩu mới <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" class="form-control" name="password_confirmation" required>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Đổi mật khẩu
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    // Handle tab switching
    document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
        tab.addEventListener('shown.bs.tab', function (e) {
            const target = e.target.getAttribute('href');
            if (target === '#change-password') {
                window.location.hash = 'change-password';
            }
        });
    });

    // Check if hash is change-password
    if (window.location.hash === '#change-password') {
        const tab = document.querySelector('[href="#change-password"]');
        if (tab) {
            const tabInstance = new bootstrap.Tab(tab);
            tabInstance.show();
        }
    }
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\DACN\WEBSITE_BENH_VIEN\resources\views/patient/profile.blade.php ENDPATH**/ ?>