

<?php $__env->startSection('title', 'Chi tiết Bác sĩ'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Chi tiết Bác sĩ</h2>
        <a href="<?php echo e(route('patient.doctors.index')); ?>" class="btn btn-secondary">Quay lại</a>
    </div>

    <div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 text-center mb-3 mb-md-0">
                <?php if($doctor->avatar): ?>
                    <img src="<?php echo e($doctor->avatar); ?>" alt="<?php echo e($doctor->user->name); ?>" 
                         class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #0d6efd;">
                <?php else: ?>
                    <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width: 150px; height: 150px;">
                        <i class="bi bi-person-badge display-4 text-primary"></i>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-9">
        <h3><?php echo e($doctor->user->name); ?></h3>
        <p class="text-muted mb-3">
            <i class="bi bi-briefcase"></i> <?php echo e($doctor->specialization); ?>

        </p>
        <p class="text-muted mb-3">
            <i class="bi bi-award"></i> <?php echo e($doctor->experience); ?> năm kinh nghiệm
        </p>
        <?php if($doctor->qualification): ?>
            <p class="text-muted mb-3">
                <i class="bi bi-mortarboard"></i> <?php echo e($doctor->qualification); ?>

            </p>
        <?php endif; ?>
        <p class="text-primary fw-bold mb-3">
            Phí tư vấn: <?php echo e(number_format($doctor->consultation_fee, 0, ',', '.')); ?> đ
        </p>
        <?php if($doctor->bio): ?>
            <p><?php echo e($doctor->bio); ?></p>
        <?php endif; ?>
        <hr>
        <p><strong>Email:</strong> <?php echo e($doctor->user->email); ?></p>
        <?php if($doctor->user->phone): ?>
            <p><strong>Số điện thoại:</strong> <?php echo e($doctor->user->phone); ?></p>
        <?php endif; ?>
        <?php if($doctor->user->address): ?>
            <p><strong>Địa chỉ:</strong> <?php echo e($doctor->user->address); ?></p>
        <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="text-center">
    <a href="<?php echo e(route('patient.appointments.create', $doctor->id)); ?>" class="btn btn-primary btn-lg">
        <i class="bi bi-calendar-plus"></i> Đặt lịch hẹn
    </a>
</div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\DACN\WEBSITE_BENH_VIEN\resources\views/patient/doctors/show.blade.php ENDPATH**/ ?>