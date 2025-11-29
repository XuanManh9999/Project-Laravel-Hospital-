@extends('layouts.app')

@section('title', 'Tạo tài khoản')

@section('content')
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Tạo tài khoản</h2>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Quay lại</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Họ và tên</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           name="password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Vai trò</label>
                    <select name="role" class="form-select @error('role') is-invalid @enderror" id="role" required>
                        <option value="">Chọn vai trò</option>
                        <option value="doctor" {{ old('role') == 'doctor' ? 'selected' : '' }}>Bác sĩ</option>
                        <option value="receptionist" {{ old('role') == 'receptionist' ? 'selected' : '' }}>Tiếp viên</option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                </div>
            </div>

            <div id="doctorFields" style="display: none;">
                <div class="mb-3">
                    <label class="form-label">Avatar (URL)</label>
                    <input type="url" class="form-control" name="avatar" value="{{ old('avatar') }}" placeholder="https://example.com/avatar.jpg">
                    <small class="form-text text-muted">Nhập URL hình ảnh avatar từ internet</small>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Chuyên khoa</label>
                        <input type="text" class="form-control" name="specialization" value="{{ old('specialization') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kinh nghiệm (năm)</label>
                        <input type="number" class="form-control" name="experience" value="{{ old('experience', 0) }}" min="0">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Bằng cấp</label>
                        <input type="text" class="form-control" name="qualification" value="{{ old('qualification') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phí tư vấn</label>
                        <input type="number" class="form-control" name="consultation_fee" value="{{ old('consultation_fee', 0) }}" min="0" step="0.01">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Giới thiệu</label>
                    <textarea class="form-control" name="bio" rows="3">{{ old('bio') }}</textarea>
                </div>
            </div>

            <div id="receptionistFields" style="display: none;">
                <div class="mb-3">
                    <label class="form-label">Ca làm việc</label>
                    <input type="text" class="form-control" name="shift" value="{{ old('shift') }}" placeholder="VD: Sáng (8h-12h)">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Tạo tài khoản</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('role').addEventListener('change', function() {
        const role = this.value;
        document.getElementById('doctorFields').style.display = role === 'doctor' ? 'block' : 'none';
        document.getElementById('receptionistFields').style.display = role === 'receptionist' ? 'block' : 'none';
    });
</script>
@endsection

