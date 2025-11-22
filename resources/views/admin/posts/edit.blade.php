@extends('layouts.app')

@section('title', 'Sửa bài viết')

@section('content')
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Sửa bài viết</h2>
    <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Quay lại</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.posts.update', $post->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Tiêu đề</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                       name="title" value="{{ old('title', $post->title) }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nội dung <span class="text-danger">*</span></label>
                <textarea id="content-editor" class="form-control @error('content') is-invalid @enderror" 
                          name="content" rows="15" required>{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">Sử dụng editor để định dạng nội dung bài viết</small>
            </div>

            @if($post->image)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Current image" class="img-thumbnail" style="max-height: 200px;">
                </div>
            @endif

            <div class="mb-3">
                <label class="form-label">Hình ảnh mới (để trống nếu không đổi)</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" 
                       name="image" accept="image/*">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <select name="status" class="form-select" required>
                    <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Bản nháp</option>
                    <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>Đã xuất bản</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Cập nhật
            </button>
        </form>
    </div>
</div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '#content-editor',
        height: 500,
        menubar: true,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | ' +
            'bold italic forecolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help | link image media | code',
        content_style: 'body { font-family: Arial, sans-serif; font-size: 14px }',
        language: 'vi',
        branding: false,
        promotion: false,
        images_upload_url: false,
        automatic_uploads: false
    });
</script>
@endpush
@endsection

