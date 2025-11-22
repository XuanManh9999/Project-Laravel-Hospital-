@extends('layouts.app')

@section('title', 'Quản lý Dịch vụ')

@section('content')
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Quản lý Dịch vụ</h2>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Thêm dịch vụ
    </a>
</div>

    <div class="card">
    <div class="card-body">
        <form method="GET" class="mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm tên, mô tả..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">Tất cả trạng thái</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Hoạt động</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Tạm dừng</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="sort" class="form-select">
                        <option value="">Sắp xếp</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Tên A-Z</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá tăng dần</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá giảm dần</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Tìm kiếm
                    </button>
                </div>
                <div class="col-md-3 text-end">
                    @if(request()->hasAny(['search', 'status', 'sort']))
                        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">
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
                        <th>Tên dịch vụ</th>
                        <th>Mô tả</th>
                        <th>Giá</th>
                        <th>Thời gian (phút)</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                        <tr>
                            <td>{{ $service->id }}</td>
                            <td>{{ $service->name }}</td>
                            <td>{{ Str::limit($service->description, 50) }}</td>
                            <td>{{ number_format($service->price, 0, ',', '.') }} đ</td>
                            <td>{{ $service->duration }}</td>
                            <td>
                                <span class="badge bg-{{ $service->status == 'active' ? 'success' : 'secondary' }}">
                                    {{ $service->status == 'active' ? 'Hoạt động' : 'Tạm dừng' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="d-inline">
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
                            <td colspan="7" class="text-center">Không có dữ liệu</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($services->hasPages())
            <div class="mt-4">
                {{ $services->links() }}
            </div>
        @endif
    </div>
</div>
</div>
@endsection

