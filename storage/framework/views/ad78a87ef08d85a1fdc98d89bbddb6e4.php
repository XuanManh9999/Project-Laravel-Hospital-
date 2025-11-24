

<?php $__env->startSection('title', 'Đặt lịch hẹn'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Đặt lịch hẹn với <?php echo e($doctor->user->name); ?></h2>
        <a href="<?php echo e(route('patient.doctors.show', $doctor->id)); ?>" class="btn btn-secondary">Quay lại</a>
    </div>

    <div class="card">
    <div class="card-body">
        <form method="POST" action="<?php echo e(route('patient.appointments.store')); ?>">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="doctor_id" value="<?php echo e($doctor->id); ?>">

            <div class="mb-3">
                <label class="form-label">Dịch vụ</label>
                <select name="service_id" class="form-select <?php $__errorArgs = ['service_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                    <option value="">Chọn dịch vụ</option>
                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($service->id); ?>" <?php echo e(old('service_id') == $service->id ? 'selected' : ''); ?>>
                            <?php echo e($service->name); ?> - <?php echo e(number_format($service->price, 0, ',', '.')); ?> đ
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['service_id'];
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

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Ngày hẹn</label>
                    <input type="date" class="form-control <?php $__errorArgs = ['appointment_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           name="appointment_date" value="<?php echo e(old('appointment_date')); ?>" 
                           min="<?php echo e(\Carbon\Carbon::now()->addDays(3)->format('Y-m-d')); ?>"
                           max="<?php echo e(\Carbon\Carbon::now()->addWeeks(2)->format('Y-m-d')); ?>" required>
                    <small class="text-muted">Tối thiểu 3 ngày, tối đa 2 tuần</small>
                    <?php $__errorArgs = ['appointment_date'];
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

                <div class="col-md-6 mb-3">
                    <label class="form-label">Giờ hẹn</label>
                    <input type="time" class="form-control <?php $__errorArgs = ['appointment_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           name="appointment_time" value="<?php echo e(old('appointment_time')); ?>" required>
                    <?php $__errorArgs = ['appointment_time'];
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
            </div>

            <div class="mb-3">
                <label class="form-label">Ghi chú</label>
                <textarea class="form-control" name="notes" rows="3" placeholder="Mô tả triệu chứng hoặc yêu cầu..."><?php echo e(old('notes')); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Đặt lịch hẹn</button>
        </form>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\DACN\WEBSITE_BENH_VIEN\resources\views/patient/appointments/create.blade.php ENDPATH**/ ?>