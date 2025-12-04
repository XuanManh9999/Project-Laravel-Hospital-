

<?php $__env->startSection('title', 'Tất cả dịch vụ'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4 px-3 px-md-4">
    <div class="mb-4 text-center">
        <h1 class="fw-bold display-5 mb-2">Tất cả dịch vụ</h1>
        <p class="text-muted lead mb-0">Danh sách đầy đủ các dịch vụ y tế đang cung cấp</p>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-4">
                <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm hover-shadow">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-heart-pulse text-danger fs-3 me-3"></i>
                                    <h5 class="card-title mb-0"><?php echo e($service->name); ?></h5>
                                </div>
                                <p class="card-text text-muted"><?php echo e($service->description); ?></p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="text-primary fw-bold fs-5"><?php echo e(number_format($service->price, 0, ',', '.')); ?> đ</span>
                                    <?php if($service->duration): ?>
                                        <small class="text-muted">
                                            <i class="bi bi-clock"></i> <?php echo e($service->duration); ?> phút
                                        </small>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center mb-0">Hiện chưa có dịch vụ nào.</div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mt-4 d-flex justify-content-center">
                <?php echo e($services->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\DACN\WEBSITE_BENH_VIEN\resources\views/services/index.blade.php ENDPATH**/ ?>