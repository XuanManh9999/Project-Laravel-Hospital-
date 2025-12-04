

<?php $__env->startSection('title', 'Đội ngũ bác sĩ'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4 px-3 px-md-4">
    <div class="mb-4 text-center">
        <h1 class="fw-bold display-5 mb-2">Đội ngũ bác sĩ</h1>
        <p class="text-muted lead mb-0">Danh sách đầy đủ các bác sĩ đang làm việc tại bệnh viện</p>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-4">
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
                        <div class="alert alert-info text-center mb-0">Hiện chưa có bác sĩ nào.</div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mt-4 d-flex justify-content-center">
                <?php echo e($doctors->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\DACN\WEBSITE_BENH_VIEN\resources\views/doctors/index.blade.php ENDPATH**/ ?>