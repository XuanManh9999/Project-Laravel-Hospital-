<footer class="bg-dark text-white mt-5">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <?php if(file_exists(public_path('images/logo.png'))): ?>
                            <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo" class="me-2" style="height: 40px; width: auto; filter: brightness(0) invert(1);">
                        <?php elseif(file_exists(public_path('images/logo.jpg'))): ?>
                            <img src="<?php echo e(asset('images/logo.jpg')); ?>" alt="Logo" class="me-2" style="height: 40px; width: auto; filter: brightness(0) invert(1);">
                        <?php else: ?>
                            <div class="logo-placeholder me-2 d-flex align-items-center justify-content-center bg-white bg-opacity-20 text-white rounded" style="width: 40px; height: 40px;">
                                <i class="bi bi-hospital fs-4"></i>
                            </div>
                        <?php endif; ?>
                        <h5 class="fw-bold mb-0 text-white">Hospital Management</h5>
                    </div>
                    <p class="text-white-50 mb-3">
                        Hệ thống quản lý bệnh viện chuyên nghiệp, hiện đại. 
                        Chăm sóc sức khỏe của bạn một cách tốt nhất.
                    </p>
                    <div class="social-links">
                        <a href="#" class="text-white me-3 fs-5" title="Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" class="text-white me-3 fs-5" title="Twitter">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a href="#" class="text-white me-3 fs-5" title="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" class="text-white fs-5" title="YouTube">
                            <i class="bi bi-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-6">
                <h6 class="fw-bold mb-3">Liên kết nhanh</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="<?php echo e(route('welcome')); ?>" class="text-white text-decoration-none">
                            <i class="bi bi-house me-1"></i> Trang chủ
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="<?php echo e(route('welcome')); ?>#services" class="text-white text-decoration-none">
                            <i class="bi bi-briefcase me-1"></i> Dịch vụ
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="<?php echo e(route('welcome')); ?>#doctors" class="text-white text-decoration-none">
                            <i class="bi bi-person-badge me-1"></i> Bác sĩ
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="<?php echo e(route('welcome')); ?>#news" class="text-white text-decoration-none">
                            <i class="bi bi-newspaper me-1"></i> Tin tức
                        </a>
                    </li>
                    <?php if(auth()->guard()->guest()): ?>
                    <li class="mb-2">
                        <a href="<?php echo e(route('login')); ?>" class="text-white text-decoration-none">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Đăng nhập
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <h6 class="fw-bold mb-3">Dịch vụ</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none">
                            <i class="bi bi-heart-pulse me-1"></i> Khám tổng quát
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none">
                            <i class="bi bi-heart me-1"></i> Tim mạch
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none">
                            <i class="bi bi-emoji-smile me-1"></i> Nhi khoa
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none">
                            <i class="bi bi-clipboard-pulse me-1"></i> Xét nghiệm
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none">
                            <i class="bi bi-droplet me-1"></i> Nội tiết
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none">
                            <i class="bi bi-bandaid me-1"></i> Da liễu
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="col-lg-3 col-md-6" id="contact">
                <h6 class="fw-bold mb-3">Liên hệ</h6>
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex align-items-start">
                        <i class="bi bi-geo-alt-fill me-2 mt-1 text-white"></i>
                        <span class="text-white">123 Đường ABC, Quận 1, TP.HCM, Việt Nam</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="bi bi-telephone-fill me-2 text-white"></i>
                        <span class="text-white">1900 1234</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="bi bi-envelope-fill me-2 text-white"></i>
                        <span class="text-white">info@hospital.com</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="bi bi-clock-fill me-2 text-white"></i>
                        <span class="text-white">24/7 - Phục vụ mọi lúc</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <hr class="my-4 bg-secondary opacity-50">
        
        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="text-white mb-0">
                    &copy; <?php echo e(date('Y')); ?> Hospital Management. Tất cả quyền được bảo lưu.
                </p>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <a href="#" class="text-white text-decoration-none me-3">Chính sách bảo mật</a>
                <a href="#" class="text-white text-decoration-none">Điều khoản sử dụng</a>
            </div>
        </div>
    </div>
</footer>

<style>
    footer a {
        color: #fff !important;
        transition: opacity 0.3s;
    }
    footer a:hover {
        opacity: 0.8;
        transition: opacity 0.3s;
    }
    .social-links a:hover {
        opacity: 0.7;
        transform: translateY(-2px);
        transition: all 0.3s;
    }
    footer .text-white-50 {
        color: rgba(255, 255, 255, 0.7) !important;
    }
</style>
<?php /**PATH D:\workspace\DACN\WEBSITE_BENH_VIEN\resources\views/components/footer.blade.php ENDPATH**/ ?>