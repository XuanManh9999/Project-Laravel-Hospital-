@extends('layouts.app')

@section('title', 'Sửa tài khoản')

@section('content')
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Sửa tài khoản</h2>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Quay lại</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Họ và tên</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Mật khẩu mới (để trống nếu không đổi)</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           name="password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" name="phone" value="{{ old('phone', $user->phone) }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" name="address" value="{{ old('address', $user->address) }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="status" class="form-select" required>
                        <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Hoạt động</option>
                        <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Khóa</option>
                    </select>
                </div>
            </div>

            @if($user->role === 'doctor' && $user->doctor)
                <hr class="my-4">
                <h5 class="mb-3">Thông tin Bác sĩ</h5>
                
                <div class="mb-3">
                    <label class="form-label">Avatar (URL)</label>
                    <input type="url" class="form-control" name="avatar" value="{{ old('avatar', $user->doctor->avatar) }}" placeholder="https://example.com/avatar.jpg">
                    <small class="form-text text-muted">Nhập URL hình ảnh avatar từ internet</small>
                    @if($user->doctor->avatar)
                        <div class="mt-2">
                            <img src="{{ $user->doctor->avatar }}" alt="Current avatar" class="img-thumbnail" style="max-height: 150px; max-width: 150px; object-fit: cover; border-radius: 50%;" onerror="this.style.display='none'">
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Chuyên khoa</label>
                        <input type="text" class="form-control" name="specialization" value="{{ old('specialization', $user->doctor->specialization) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kinh nghiệm (năm)</label>
                        <input type="number" class="form-control" name="experience" value="{{ old('experience', $user->doctor->experience) }}" min="0">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Bằng cấp</label>
                        <input type="text" class="form-control" name="qualification" value="{{ old('qualification', $user->doctor->qualification) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phí tư vấn</label>
                        <input type="number" class="form-control" name="consultation_fee" value="{{ old('consultation_fee', $user->doctor->consultation_fee) }}" min="0" step="0.01">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Giới thiệu</label>
                    <textarea class="form-control" name="bio" rows="3">{{ old('bio', $user->doctor->bio) }}</textarea>
                </div>
            @endif

            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</div>
</div>
@endsection

