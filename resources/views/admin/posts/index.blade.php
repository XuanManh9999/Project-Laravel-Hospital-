@extends('layouts.app')

@section('title', 'Quản lý Bài viết')

@section('content')
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Quản lý Bài viết</h2>
    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Thêm bài viết
    </a>
</div>

    <div class="card">
    <div class="card-body">
        <form method="GET" class="mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm tiêu đề, nội dung..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">Tất cả trạng thái</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Đã xuất bản</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Bản nháp</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="author_id" class="form-select">
                        <option value="">Tất cả tác giả</option>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}" {{ request('author_id') == $author->id ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Tìm kiếm
                    </button>
                </div>
                <div class="col-md-3 text-end">
                    @if(request()->hasAny(['search', 'status', 'author_id']))
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle"></i> Xóa bộ lọc
                        </a>
                    @endif
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
                    @forelse($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->author->name }}</td>
                            <td>
                                <span class="badge bg-{{ $post->status == 'published' ? 'success' : 'secondary' }}">
                                    {{ $post->status == 'published' ? 'Đã xuất bản' : 'Bản nháp' }}
                                </span>
                            </td>
                            <td>{{ $post->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Không có dữ liệu</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($posts->hasPages())
            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
</div>
</div>
@endsection

