@extends('layouts.app')

@section('title', 'Quản lý Tài khoản')

@section('content')
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Quản lý Tài khoản</h2>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tạo tài khoản
    </a>
</div>

    <div class="card">
    <div class="card-body">
        <form method="GET" class="mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm tên, email, SĐT..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <select name="role" class="form-select">
                        <option value="">Tất cả vai trò</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="doctor" {{ request('role') == 'doctor' ? 'selected' : '' }}>Bác sĩ</option>
                        <option value="receptionist" {{ request('role') == 'receptionist' ? 'selected' : '' }}>Tiếp viên</option>
                        <option value="patient" {{ request('role') == 'patient' ? 'selected' : '' }}>Bệnh nhân</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">Tất cả trạng thái</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Hoạt động</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Khóa</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Tìm kiếm
                    </button>
                </div>
                <div class="col-md-3 text-end">
                    @if(request()->hasAny(['search', 'role', 'status']))
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
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
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Vai trò</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge bg-info">
                                    @if($user->role == 'admin') Admin
                                    @elseif($user->role == 'doctor') Bác sĩ
                                    @elseif($user->role == 'receptionist') Tiếp viên
                                    @else Bệnh nhân
                                    @endif
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $user->status == 'active' ? 'success' : 'danger' }}">
                                    {{ $user->status == 'active' ? 'Hoạt động' : 'Khóa' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                @if($user->role == 'patient')
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endif
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

        {{ $users->links() }}
    </div>
</div>
</div>
@endsection

