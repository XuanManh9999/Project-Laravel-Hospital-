

<?php $__env->startSection('title', 'Danh sách Bác sĩ'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Danh sách Bác sĩ</h2>
    </div>

    <div class="row g-4">
    <?php $__empty_1 = true; $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <?php if($doctor->avatar): ?>
                            <img src="<?php echo e($doctor->avatar); ?>" alt="<?php echo e($doctor->user->name); ?>" 
                                 class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #0d6efd;">
                        <?php else: ?>
                            <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width: 120px; height: 120px;">
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
                        <p class="text-muted mb-2">
                            <i class="bi bi-mortarboard"></i> <?php echo e($doctor->qualification); ?>

                        </p>
                    <?php endif; ?>
                    <p class="text-primary fw-bold mb-3">
                        Phí tư vấn: <?php echo e(number_format($doctor->consultation_fee, 0, ',', '.')); ?> đ
                    </p>
                    <?php if($doctor->bio): ?>
                        <p class="card-text"><?php echo e(Str::limit($doctor->bio, 100)); ?></p>
                    <?php endif; ?>
                    <a href="<?php echo e(route('patient.doctors.show', $doctor->id)); ?>" class="btn btn-primary w-100">
                        Xem chi tiết
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12">
            <div class="alert alert-info">Không có bác sĩ nào.</div>
        </div>
    <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\DACN\WEBSITE_BENH_VIEN\resources\views/patient/doctors/index.blade.php ENDPATH**/ ?>