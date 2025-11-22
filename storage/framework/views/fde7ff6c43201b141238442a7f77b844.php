<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Hệ thống Quản lý Bệnh viện'); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .main-content {
            background-color: #f8f9fa;
            min-height: calc(100vh - 200px);
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(102, 126, 234, 0.4);
        }
        .navbar-brand {
            font-size: 1.5rem;
        }
        .social-links a:hover {
            opacity: 0.7;
            transition: opacity 0.3s;
        }
        /* Fix dropdown z-index */
        .navbar {
            z-index: 1030 !important;
        }
        .dropdown-menu {
            z-index: 1051 !important;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 0.5rem;
        }
        .dropdown-item:hover {
            background-color: #f8f9fa;
        }
        .dropdown-item i {
            width: 20px;
        }
        .list-group-item-action.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: transparent;
        }
        .nav-link {
            transition: color 0.3s;
        }
        .nav-link:hover {
            color: #667eea !important;
        }
        /* Sidebar styles for admin */
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: white !important;
        }
        /* Back to Top Button */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 50%;
            display: none;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
            transition: all 0.3s ease;
        }
        .back-to-top:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(102, 126, 234, 0.6);
        }
        .back-to-top.show {
            display: flex;
        }
        .back-to-top i {
            font-size: 1.5rem;
        }
        /* Fix anchor scroll offset for sticky header */
        html {
            scroll-padding-top: 80px;
        }
        section[id] {
            scroll-margin-top: 80px;
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <?php if(auth()->guard()->check()): ?>
        <?php if(auth()->user()->isAdmin()): ?>
            
            <div class="container-fluid">
                <div class="row">
                    <nav class="col-md-3 col-lg-2 sidebar p-3" style="min-height: 100vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <div class="text-center mb-4">
                            <h4 class="text-white">🏥 Hospital</h4>
                        </div>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('admin.dashboard')); ?>" style="color: rgba(255,255,255,0.8); padding: 12px 20px; margin: 5px 0; border-radius: 8px; transition: all 0.3s;">
                                    <i class="bi bi-speedometer2"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.users.index')); ?>" style="color: rgba(255,255,255,0.8); padding: 12px 20px; margin: 5px 0; border-radius: 8px; transition: all 0.3s;">
                                    <i class="bi bi-people"></i> Quản lý Tài khoản
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->routeIs('admin.services.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.services.index')); ?>" style="color: rgba(255,255,255,0.8); padding: 12px 20px; margin: 5px 0; border-radius: 8px; transition: all 0.3s;">
                                    <i class="bi bi-briefcase"></i> Dịch vụ
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->routeIs('admin.posts.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.posts.index')); ?>" style="color: rgba(255,255,255,0.8); padding: 12px 20px; margin: 5px 0; border-radius: 8px; transition: all 0.3s;">
                                    <i class="bi bi-file-text"></i> Bài viết
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->routeIs('admin.appointments.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.appointments.index')); ?>" style="color: rgba(255,255,255,0.8); padding: 12px 20px; margin: 5px 0; border-radius: 8px; transition: all 0.3s;">
                                    <i class="bi bi-calendar-check"></i> Lịch hẹn
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->routeIs('admin.refunds.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.refunds.index')); ?>" style="color: rgba(255,255,255,0.8); padding: 12px 20px; margin: 5px 0; border-radius: 8px; transition: all 0.3s;">
                                    <i class="bi bi-arrow-counterclockwise"></i> Hoàn tiền
                                </a>
                            </li>
                        </ul>
                        <div class="mt-auto pt-4">
                            <a class="nav-link" href="<?php echo e(route('welcome')); ?>" style="color: rgba(255,255,255,0.8); padding: 12px 20px; margin: 5px 0; border-radius: 8px; transition: all 0.3s;">
                                <i class="bi bi-house"></i> Trang chủ
                            </a>
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="nav-link w-100 text-start border-0 bg-transparent" style="color: rgba(255,255,255,0.8); padding: 12px 20px; margin: 5px 0; border-radius: 8px; transition: all 0.3s;">
                                    <i class="bi bi-box-arrow-right"></i> Đăng xuất
                                </button>
                            </form>
                        </div>
                    </nav>
                    <main class="col-md-9 ms-sm-auto col-lg-10 main-content p-4">
                        <?php if(session('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle me-2"></i><?php echo e(session('success')); ?>

                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>
                        <?php echo $__env->yieldContent('content'); ?>
                    </main>
                </div>
            </div>
        <?php else: ?>
            
            <?php echo $__env->make('components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
            <main class="main-content">
                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                        <i class="bi bi-check-circle me-2"></i><?php echo e(session('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                        <ul class="mb-0">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                <?php echo $__env->yieldContent('content'); ?>
            </main>
            
            <?php echo $__env->make('components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    <?php else: ?>
        
        <?php echo $__env->make('components.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <main class="main-content">
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                    <i class="bi bi-check-circle me-2"></i><?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            <?php if($errors->any()): ?>
                <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            <?php echo $__env->yieldContent('content'); ?>
        </main>
        
        <?php echo $__env->make('components.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <!-- Back to Top Button -->
    <button class="back-to-top" id="backToTop" aria-label="Quay về đầu trang">
        <i class="bi bi-arrow-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Back to Top Button
        const backToTopButton = document.getElementById('backToTop');
        
        // Show/hide button based on scroll position
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.add('show');
            } else {
                backToTopButton.classList.remove('show');
            }
        });
        
        // Smooth scroll to top when button is clicked
        backToTopButton.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Fix anchor links scroll offset for sticky header
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href === '#' || href === '') return;
                
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    const headerHeight = document.querySelector('header')?.offsetHeight || 80;
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\workspace\DACN\WEBSITE_BENH_VIEN\resources\views/layouts/app.blade.php ENDPATH**/ ?>