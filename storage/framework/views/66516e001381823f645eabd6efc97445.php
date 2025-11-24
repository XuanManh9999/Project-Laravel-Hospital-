

<?php $__env->startSection('title', $post->title); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4 px-3 px-md-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('welcome')); ?>">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('posts.index')); ?>">Tin tức</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e(Str::limit($post->title, 50)); ?></li>
        </ol>
    </nav>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <article class="card border-0 shadow-sm mb-4">
                <?php if($post->image): ?>
                    <img src="<?php echo e(asset('storage/' . $post->image)); ?>" 
                         class="card-img-top" 
                         alt="<?php echo e($post->title); ?>"
                         style="max-height: 400px; object-fit: cover;">
                <?php endif; ?>
                
                <div class="card-body p-4">
                    <h1 class="card-title mb-3 fw-bold"><?php echo e($post->title); ?></h1>
                    
                    <div class="d-flex flex-wrap align-items-center gap-3 mb-4 text-muted">
                        <div>
                            <i class="bi bi-person-circle"></i>
                            <strong><?php echo e($post->author->name); ?></strong>
                        </div>
                        <div>
                            <i class="bi bi-calendar3"></i>
                            <?php echo e($post->created_at->format('d/m/Y H:i')); ?>

                        </div>
                        <div>
                            <i class="bi bi-eye"></i>
                            Đã xem
                        </div>
                    </div>

                    <hr>

                    <div class="post-content">
                        <?php echo $post->content; ?>

                    </div>

                    <hr class="my-4">

                    <!-- Share buttons -->
                    <div class="d-flex align-items-center gap-3">
                        <span class="text-muted">Chia sẻ:</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(url()->current())); ?>" 
                           target="_blank" 
                           class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-facebook"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode(url()->current())); ?>&text=<?php echo e(urlencode($post->title)); ?>" 
                           target="_blank" 
                           class="btn btn-sm btn-outline-info">
                            <i class="bi bi-twitter"></i> Twitter
                        </a>
                        <button class="btn btn-sm btn-outline-secondary" onclick="copyToClipboard()">
                            <i class="bi bi-link-45deg"></i> Copy link
                        </button>
                    </div>
                </div>
            </article>

            <!-- Related Posts -->
            <?php if($relatedPosts->count() > 0): ?>
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-newspaper"></i> Bài viết liên quan
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <?php $__currentLoopData = $relatedPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relatedPost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-4">
                                    <div class="card border-0 h-100 hover-shadow">
                                        <?php if($relatedPost->image): ?>
                                            <img src="<?php echo e(asset('storage/' . $relatedPost->image)); ?>" 
                                                 class="card-img-top" 
                                                 alt="<?php echo e($relatedPost->title); ?>"
                                                 style="height: 150px; object-fit: cover;">
                                        <?php endif; ?>
                                        <div class="card-body">
                                            <h6 class="card-title">
                                                <a href="<?php echo e(route('posts.show', $relatedPost->id)); ?>" class="text-decoration-none">
                                                    <?php echo e(Str::limit($relatedPost->title, 60)); ?>

                                                </a>
                                            </h6>
                                            <small class="text-muted">
                                                <i class="bi bi-calendar"></i> <?php echo e($relatedPost->created_at->format('d/m/Y')); ?>

                                            </small>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Latest Posts -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-clock-history"></i> Bài viết mới nhất
                    </h5>
                </div>
                <div class="list-group list-group-flush">
                    <?php
                        $latestPosts = \App\Models\Post::where('status', 'published')
                            ->where('id', '!=', $post->id)
                            ->with('author')
                            ->latest()
                            ->limit(5)
                            ->get();
                    ?>
                    <?php $__empty_1 = true; $__currentLoopData = $latestPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $latestPost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <a href="<?php echo e(route('posts.show', $latestPost->id)); ?>" 
                           class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1"><?php echo e(Str::limit($latestPost->title, 50)); ?></h6>
                            </div>
                            <small class="text-muted">
                                <i class="bi bi-calendar"></i> <?php echo e($latestPost->created_at->format('d/m/Y')); ?>

                            </small>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="list-group-item text-muted text-center">
                            Chưa có bài viết nào
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Back to list -->
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <a href="<?php echo e(route('posts.index')); ?>" class="btn btn-primary w-100">
                        <i class="bi bi-arrow-left"></i> Xem tất cả bài viết
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('styles'); ?>
<style>
    .post-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #333;
    }
    .post-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 20px 0;
    }
    .post-content p {
        margin-bottom: 1.5rem;
    }
    .post-content h1, .post-content h2, .post-content h3 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: bold;
    }
    .post-content ul, .post-content ol {
        margin-bottom: 1.5rem;
        padding-left: 2rem;
    }
    .post-content a {
        color: #667eea;
        text-decoration: underline;
    }
    .post-content a:hover {
        color: #764ba2;
    }
    .hover-shadow {
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .hover-shadow:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1) !important;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    function copyToClipboard() {
        const url = window.location.href;
        navigator.clipboard.writeText(url).then(function() {
            alert('Đã copy link vào clipboard!');
        }, function() {
            // Fallback for older browsers
            const textArea = document.createElement('textarea');
            textArea.value = url;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            alert('Đã copy link vào clipboard!');
        });
    }
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\DACN\WEBSITE_BENH_VIEN\resources\views/posts/show.blade.php ENDPATH**/ ?>