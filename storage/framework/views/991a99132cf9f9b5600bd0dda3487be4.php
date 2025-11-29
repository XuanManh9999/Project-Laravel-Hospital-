

<?php $__env->startSection('title', 'Trang chủ - Hệ thống Quản lý Bệnh viện'); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Section -->
<section class="hero-section text-white py-5 mb-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); margin-top: -1px;">
    <div class="container">
        <div class="row align-items-center py-5">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">
                    <i class="bi bi-hospital"></i> Hệ thống Quản lý Bệnh viện
                </h1>
                <p class="lead mb-4 fs-5">
                    Chăm sóc sức khỏe của bạn một cách chuyên nghiệp và tiện lợi. 
                    Đặt lịch hẹn dễ dàng, nhanh chóng với đội ngũ bác sĩ giàu kinh nghiệm.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->user()->isPatient()): ?>
                            <a href="<?php echo e(route('patient.doctors.index')); ?>" class="btn btn-light btn-lg">
                                <i class="bi bi-calendar-plus"></i> Đặt lịch hẹn
                            </a>
                            <a href="<?php echo e(route('patient.profile')); ?>" class="btn btn-outline-light btn-lg">
                                <i class="bi bi-person"></i> Thông tin cá nhân
                            </a>
                        <?php elseif(auth()->user()->isDoctor()): ?>
                            <a href="<?php echo e(route('doctor.appointments.index')); ?>" class="btn btn-light btn-lg">
                                <i class="bi bi-calendar-check"></i> Lịch hẹn của tôi
                            </a>
                            <a href="<?php echo e(route('doctor.profile')); ?>" class="btn btn-outline-light btn-lg">
                                <i class="bi bi-person"></i> Thông tin cá nhân
                            </a>
                        <?php elseif(auth()->user()->isReceptionist()): ?>
                            <a href="<?php echo e(route('receptionist.appointments.index')); ?>" class="btn btn-light btn-lg">
                                <i class="bi bi-calendar-check"></i> Lịch hẹn phòng khám
                            </a>
                            <a href="<?php echo e(route('receptionist.profile')); ?>" class="btn btn-outline-light btn-lg">
                                <i class="bi bi-person"></i> Thông tin cá nhân
                            </a>
                        <?php elseif(auth()->user()->isAdmin()): ?>
                            <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-light btn-lg">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                            <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-outline-light btn-lg">
                                <i class="bi bi-people"></i> Quản lý hệ thống
                            </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="<?php echo e(route('register')); ?>" class="btn btn-light btn-lg">
                            <i class="bi bi-person-plus"></i> Đăng ký ngay
                        </a>
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-light btn-lg">
                            <i class="bi bi-box-arrow-in-right"></i> Đăng nhập
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <?php if(file_exists(public_path('images/logo.png'))): ?>
                    <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Hospital Logo" class="img-fluid" style="max-height: 400px; filter: drop-shadow(0 10px 30px rgba(255,255,255,0.3));">
                <?php elseif(file_exists(public_path('images/logo.jpg'))): ?>
                    <img src="<?php echo e(asset('images/logo.jpg')); ?>" alt="Hospital Logo" class="img-fluid" style="max-height: 400px; filter: drop-shadow(0 10px 30px rgba(255,255,255,0.3));">
                <?php else: ?>
                    <div class="logo-hero d-flex align-items-center justify-content-center mx-auto" style="width: 300px; height: 300px; background: rgba(255,255,255,0.1); border-radius: 50%; border: 5px solid rgba(255,255,255,0.3);">
                        <i class="bi bi-hospital display-1 text-white"></i>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <!-- Features Section -->
    <section class="mb-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold display-5">Tại sao chọn chúng tôi?</h2>
            <p class="text-muted lead">Dịch vụ y tế chất lượng cao, chuyên nghiệp</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 text-center border-0 shadow-sm hover-shadow">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="bi bi-person-badge display-4 text-primary"></i>
                        </div>
                        <h3 class="h4 mb-3">Bác sĩ chuyên nghiệp</h3>
                        <p class="text-muted">Đội ngũ bác sĩ giàu kinh nghiệm, được đào tạo bài bản và tận tâm với nghề</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 text-center border-0 shadow-sm hover-shadow">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="bi bi-calendar-check display-4 text-success"></i>
                        </div>
                        <h3 class="h4 mb-3">Đặt lịch dễ dàng</h3>
                        <p class="text-muted">Đặt lịch hẹn trực tuyến nhanh chóng, tiện lợi, không cần chờ đợi</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 text-center border-0 shadow-sm hover-shadow">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="bi bi-shield-check display-4 text-info"></i>
                        </div>
                        <h3 class="h4 mb-3">An toàn và bảo mật</h3>
                        <p class="text-muted">Thông tin được bảo mật và mã hóa an toàn, đảm bảo quyền riêng tư</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="mb-5 py-5" style="background: #f8f9fa; border-radius: 15px;">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold display-5">Dịch vụ của chúng tôi</h2>
                <p class="text-muted lead">Các dịch vụ y tế chất lượng cao</p>
            </div>
            <div class="row g-4">
                <?php
                    $services = \App\Models\Service::where('status', 'active')->limit(6)->get();
                ?>
                <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm hover-shadow">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-heart-pulse text-danger fs-3 me-3"></i>
                                    <h5 class="card-title mb-0"><?php echo e($service->name); ?></h5>
                                </div>
                                <p class="card-text text-muted"><?php echo e(Str::limit($service->description, 100)); ?></p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="text-primary fw-bold fs-5"><?php echo e(number_format($service->price, 0, ',', '.')); ?> đ</span>
                                    <small class="text-muted">
                                        <i class="bi bi-clock"></i> <?php echo e($service->duration); ?> phút
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center">Chưa có dịch vụ nào</div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Doctors Section -->
    <section id="doctors" class="mb-5 py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold display-5">Đội ngũ bác sĩ</h2>
            <p class="text-muted lead">Các chuyên gia hàng đầu</p>
        </div>
        <div class="row g-4">
            <?php
                $doctors = \App\Models\Doctor::with('user')->whereHas('user', function($q) {
                    $q->where('status', 'active');
                })->limit(4)->get();
            ?>
            <?php $__empty_1 = true; $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-3">
                    <div class="card h-100 border-0 shadow-sm text-center hover-shadow">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <?php if($doctor->avatar): ?>
                                    <img src="<?php echo e($doctor->avatar); ?>" alt="<?php echo e($doctor->user->name); ?>" 
                                         class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover; border: 3px solid #0d6efd;">
                                <?php else: ?>
                                    <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                                        <i class="bi bi-person-circle display-4 text-primary"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <h5 class="card-title"><?php echo e($doctor->user->name); ?></h5>
                            <p class="text-muted mb-2">
                                <i class="bi bi-briefcase"></i> <?php echo e($doctor->specialization); ?>

                            </p>
                            <p class="text-muted mb-2">
                                <i class="bi bi-award"></i> <?php echo e($doctor->experience); ?> năm kinh nghiệm
                            </p>
                            <?php if($doctor->qualification): ?>
                                <p class="text-muted small mb-2">
                                    <i class="bi bi-mortarboard"></i> <?php echo e($doctor->qualification); ?>

                                </p>
                            <?php endif; ?>
                            <p class="text-primary fw-bold mb-0">
                                <?php echo e(number_format($doctor->consultation_fee, 0, ',', '.')); ?> đ
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12">
                    <div class="alert alert-info text-center">Chưa có bác sĩ nào</div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="mb-5 py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 15px;">
        <div class="container">
            <div class="row g-4 text-white text-center">
                <div class="col-md-3">
                    <div class="p-4">
                        <i class="bi bi-person-badge display-4 mb-3"></i>
                        <h3 class="display-4 fw-bold"><?php echo e(\App\Models\Doctor::count()); ?></h3>
                        <p class="lead mb-0">Bác sĩ</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-4">
                        <i class="bi bi-people display-4 mb-3"></i>
                        <h3 class="display-4 fw-bold"><?php echo e(\App\Models\Patient::count()); ?></h3>
                        <p class="lead mb-0">Bệnh nhân</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-4">
                        <i class="bi bi-briefcase display-4 mb-3"></i>
                        <h3 class="display-4 fw-bold"><?php echo e(\App\Models\Service::where('status', 'active')->count()); ?></h3>
                        <p class="lead mb-0">Dịch vụ</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-4">
                        <i class="bi bi-calendar-check display-4 mb-3"></i>
                        <h3 class="display-4 fw-bold"><?php echo e(\App\Models\Appointment::where('status', 'accepted')->count()); ?></h3>
                        <p class="lead mb-0">Lịch hẹn</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Posts Section -->
    <section id="news" class="mb-5 py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold display-5">Tin tức sức khỏe</h2>
            <p class="text-muted lead">Cập nhật thông tin y tế mới nhất</p>
            <a href="<?php echo e(route('posts.index')); ?>" class="btn btn-outline-primary mt-2">
                <i class="bi bi-newspaper"></i> Xem tất cả tin tức
            </a>
        </div>
        <div class="row g-4">
            <?php
                $posts = \App\Models\Post::where('status', 'published')->with('author')->latest()->limit(3)->get();
            ?>
            <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm hover-shadow">
                        <?php if($post->image): ?>
                            <a href="<?php echo e(route('posts.show', $post->id)); ?>">
                                <img src="<?php echo e($post->image); ?>" 
                                     class="card-img-top" 
                                     alt="<?php echo e($post->title); ?>"
                                     style="height: 200px; object-fit: cover;"
                                     onerror="this.style.display='none'">
                            </a>
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="<?php echo e(route('posts.show', $post->id)); ?>" class="text-decoration-none text-dark">
                                    <?php echo e($post->title); ?>

                                </a>
                            </h5>
                            <p class="card-text text-muted"><?php echo e(Str::limit(strip_tags($post->content), 150)); ?></p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <small class="text-muted">
                                    <i class="bi bi-person"></i> <?php echo e($post->author->name); ?>

                                </small>
                                <small class="text-muted">
                                    <i class="bi bi-calendar"></i> <?php echo e($post->created_at->format('d/m/Y')); ?>

                                </small>
                            </div>
                            <div class="mt-3">
                                <a href="<?php echo e(route('posts.show', $post->id)); ?>" class="btn btn-sm btn-outline-primary">
                                    Đọc thêm <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12">
                    <div class="alert alert-info text-center">Chưa có bài viết nào</div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- CTA Section -->
    <?php if(auth()->guard()->guest()): ?>
    <section class="mb-5 py-5" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); border-radius: 15px;">
        <div class="container text-center">
            <h2 class="fw-bold display-5 mb-3">Sẵn sàng bắt đầu?</h2>
            <p class="lead text-muted mb-4">Đăng ký tài khoản ngay để đặt lịch hẹn với bác sĩ</p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="<?php echo e(route('register')); ?>" class="btn btn-primary btn-lg">
                    <i class="bi bi-person-plus"></i> Đăng ký ngay
                </a>
                <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-primary btn-lg">
                    <i class="bi bi-box-arrow-in-right"></i> Đăng nhập
                </a>
            </div>
        </div>
    </section>
    <?php endif; ?>
</div>

<!-- Contact Section (using footer as contact) -->
<div id="contact"></div>

<?php $__env->startPush('styles'); ?>
<style>
    .hover-shadow {
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
    }
    .hero-section {
        margin-top: -1px;
    }
    .card-title a:hover {
        color: #667eea !important;
    }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\DACN\WEBSITE_BENH_VIEN\resources\views/welcome.blade.php ENDPATH**/ ?>