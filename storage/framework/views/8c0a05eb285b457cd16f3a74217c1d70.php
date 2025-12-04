

<?php $__env->startSection('title', 'Tin tức sức khỏe'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4 px-3 px-md-4">
    <div class="text-center mb-5">
        <h1 class="fw-bold display-5 mb-3">Tin tức sức khỏe</h1>
        <p class="text-muted lead">Cập nhật thông tin y tế mới nhất</p>
    </div>

    <div class="row g-4">
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
                        <p class="card-text text-muted"><?php echo e(Str::limit(strip_tags(html_entity_decode($post->content, ENT_QUOTES, 'UTF-8')), 150)); ?></p>
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
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle"></i> Chưa có bài viết nào
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php if($posts->hasPages()): ?>
        <div class="mt-5 d-flex justify-content-center">
            <div class="w-100">
                <?php echo e($posts->links()); ?>

            </div>
        </div>
    <?php endif; ?>
</div>

<?php $__env->startPush('styles'); ?>
<style>
    .hover-shadow {
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
    }
    .card-title a:hover {
        color: #667eea !important;
    }
    /* Pagination styles */
    .pagination {
        margin: 0;
        justify-content: center;
    }
    .pagination .page-link {
        color: #667eea;
        border-color: #dee2e6;
        padding: 0.5rem 0.75rem;
    }
    .pagination .page-link:hover {
        color: #764ba2;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }
    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-color: #667eea;
        color: white;
    }
    .pagination .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        background-color: #fff;
        border-color: #dee2e6;
    }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\DACN\WEBSITE_BENH_VIEN\resources\views/posts/index.blade.php ENDPATH**/ ?>