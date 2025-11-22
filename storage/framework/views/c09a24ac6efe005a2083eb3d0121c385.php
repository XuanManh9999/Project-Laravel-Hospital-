<header class="bg-white shadow-sm sticky-top" style="z-index: 1030;">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary d-flex align-items-center" href="<?php echo e(route('welcome')); ?>">
                <?php if(file_exists(public_path('images/logo.png'))): ?>
                    <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo" class="me-2" style="height: 40px; width: auto;">
                <?php elseif(file_exists(public_path('images/logo.jpg'))): ?>
                    <img src="<?php echo e(asset('images/logo.jpg')); ?>" alt="Logo" class="me-2" style="height: 40px; width: auto;">
                <?php else: ?>
                    <div class="logo-placeholder me-2 d-flex align-items-center justify-content-center bg-primary text-white rounded" style="width: 40px; height: 40px;">
                        <i class="bi bi-hospital fs-4"></i>
                    </div>
                <?php endif; ?>
                <span class="d-none d-md-inline">Hospital Management</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('welcome')); ?>#services">
                            <i class="bi bi-briefcase"></i> Dịch vụ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('welcome')); ?>#doctors">
                            <i class="bi bi-person-badge"></i> Bác sĩ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('posts.index')); ?>">
                            <i class="bi bi-newspaper"></i> Tin tức
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('welcome')); ?>#contact">
                            <i class="bi bi-telephone"></i> Liên hệ
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <?php if(auth()->guard()->check()): ?>
                        <li class="nav-item dropdown" style="position: relative;">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="z-index: 1050;">
                                <i class="bi bi-person-circle me-2"></i> <?php echo e(auth()->user()->name); ?>

                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="navbarDropdown" style="z-index: 1051; min-width: 250px;">
                                <li>
                                    <h6 class="dropdown-header">
                                        <i class="bi bi-person-badge"></i> <?php echo e(ucfirst(auth()->user()->role)); ?>

                                    </h6>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="<?php echo e(route('welcome')); ?>">
                                        <i class="bi bi-house me-2"></i> Trang chủ
                                    </a>
                                </li>
                                <?php if(auth()->user()->isAdmin()): ?>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo e(route('admin.dashboard')); ?>">
                                            <i class="bi bi-speedometer2 me-2"></i> Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo e(route('admin.users.index')); ?>">
                                            <i class="bi bi-people me-2"></i> Quản lý tài khoản
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo e(route(auth()->user()->role . '.profile')); ?>">
                                            <i class="bi bi-person me-2"></i> Thông tin cá nhân
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo e(route(auth()->user()->role . '.profile')); ?>#change-password">
                                            <i class="bi bi-key me-2"></i> Đổi mật khẩu
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if(auth()->user()->isPatient()): ?>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo e(route('patient.history')); ?>">
                                            <i class="bi bi-calendar-check me-2"></i> Lịch khám của tôi
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo e(route('patient.doctors.index')); ?>">
                                            <i class="bi bi-person-badge me-2"></i> Đặt lịch hẹn
                                        </a>
                                    </li>
                                <?php elseif(auth()->user()->isDoctor()): ?>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo e(route('doctor.appointments.index')); ?>">
                                            <i class="bi bi-calendar-check me-2"></i> Lịch hẹn của tôi
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo e(route('doctor.history')); ?>">
                                            <i class="bi bi-clock-history me-2"></i> Lịch sử
                                        </a>
                                    </li>
                                <?php elseif(auth()->user()->isReceptionist()): ?>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo e(route('receptionist.appointments.index')); ?>">
                                            <i class="bi bi-calendar-check me-2"></i> Lịch hẹn phòng khám
                                        </a>
                                    </li>
                                <?php elseif(auth()->user()->isAdmin()): ?>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo e(route('admin.dashboard')); ?>">
                                            <i class="bi bi-speedometer2 me-2"></i> Dashboard
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="<?php echo e(route('logout')); ?>" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i> Đăng xuất
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('login')); ?>">
                                <i class="bi bi-box-arrow-in-right"></i> Đăng nhập
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary ms-2" href="<?php echo e(route('register')); ?>">
                                <i class="bi bi-person-plus"></i> Đăng ký
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>

<style>
    .navbar {
        z-index: 1030;
    }
    .dropdown-menu {
        z-index: 1051 !important;
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .dropdown-item:hover {
        background-color: #f8f9fa;
    }
    .dropdown-item i {
        width: 20px;
    }
</style>
<?php /**PATH D:\workspace\DACN\WEBSITE_BENH_VIEN\resources\views/components/header.blade.php ENDPATH**/ ?>