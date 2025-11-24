

<?php $__env->startSection('title', 'Quản lý Bài viết'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Quản lý Bài viết</h2>
    <a href="<?php echo e(route('admin.posts.create')); ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Thêm bài viết
    </a>
</div>

    <div class="card">
    <div class="card-body">
        <form method="GET" class="mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm tiêu đề, nội dung..." value="<?php echo e(request('search')); ?>">
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">Tất cả trạng thái</option>
                        <option value="published" <?php echo e(request('status') == 'published' ? 'selected' : ''); ?>>Đã xuất bản</option>
                        <option value="draft" <?php echo e(request('status') == 'draft' ? 'selected' : ''); ?>>Bản nháp</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="author_id" class="form-select">
                        <option value="">Tất cả tác giả</option>
                        <?php $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($author->id); ?>" <?php echo e(request('author_id') == $author->id ? 'selected' : ''); ?>>
                                <?php echo e($author->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Tìm kiếm
                    </button>
                </div>
                <div class="col-md-3 text-end">
                    <?php if(request()->hasAny(['search', 'status', 'author_id'])): ?>
                        <a href="<?php echo e(route('admin.posts.index')); ?>" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle"></i> Xóa bộ lọc
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>Tác giả</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($post->id); ?></td>
                            <td><?php echo e($post->title); ?></td>
                            <td><?php echo e($post->author->name); ?></td>
                            <td>
                                <span class="badge bg-<?php echo e($post->status == 'published' ? 'success' : 'secondary'); ?>">
                                    <?php echo e($post->status == 'published' ? 'Đã xuất bản' : 'Bản nháp'); ?>

                                </span>
                            </td>
                            <td><?php echo e($post->created_at->format('d/m/Y')); ?></td>
                            <td>
                                <a href="<?php echo e(route('admin.posts.edit', $post->id)); ?>" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="<?php echo e(route('admin.posts.destroy', $post->id)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center">Không có dữ liệu</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($posts->hasPages()): ?>
            <div class="mt-4">
                <?php echo e($posts->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\workspace\DACN\WEBSITE_BENH_VIEN\resources\views/admin/posts/index.blade.php ENDPATH**/ ?>