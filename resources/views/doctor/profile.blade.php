@extends('layouts.app')

@section('title', 'Thông tin cá nhân')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                            <i class="bi bi-person-badge display-4 text-primary"></i>
                        </div>
                    </div>
                    <h5 class="mb-1">{{ auth()->user()->name }}</h5>
                    <p class="text-muted small mb-0">{{ auth()->user()->email }}</p>
                    <span class="badge bg-success mt-2">Bác sĩ</span>
                </div>
            </div>
            
            <div class="card border-0 shadow-sm mt-3">
                <div class="list-group list-group-flush">
                    <a href="#profile-info" class="list-group-item list-group-item-action active" data-bs-toggle="tab">
                        <i class="bi bi-person me-2"></i> Thông tin cá nhân
                    </a>
                    <a href="#change-password" class="list-group-item list-group-item-action" data-bs-toggle="tab">
                        <i class="bi bi-key me-2"></i> Đổi mật khẩu
                    </a>
                    <a href="{{ route('doctor.appointments.index') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-calendar-check me-2"></i> Lịch hẹn của tôi
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h4 class="mb-0">
                        <i class="bi bi-person"></i> Thông tin cá nhân
                    </h4>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <!-- Profile Info Tab -->
                        <div class="tab-pane fade show active" id="profile-info">
                            <form method="POST" action="{{ route('doctor.profile.update') }}">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-person"></i> Họ và tên <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-envelope"></i> Email <span class="text-danger">*</span>
                                        </label>
                                        <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-telephone"></i> Số điện thoại
                                        </label>
                                        <input type="text" class="form-control" name="phone" value="{{ auth()->user()->phone }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-geo-alt"></i> Địa chỉ
                                        </label>
                                        <input type="text" class="form-control" name="address" value="{{ auth()->user()->address }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-briefcase"></i> Chuyên khoa <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="specialization" value="{{ $doctor->specialization }}" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-award"></i> Kinh nghiệm (năm)
                                        </label>
                                        <input type="number" class="form-control" name="experience" value="{{ $doctor->experience }}" min="0">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-mortarboard"></i> Bằng cấp
                                        </label>
                                        <input type="text" class="form-control" name="qualification" value="{{ $doctor->qualification }}">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-currency-dollar"></i> Phí tư vấn
                                        </label>
                                        <input type="number" class="form-control" name="consultation_fee" value="{{ $doctor->consultation_fee }}" min="0" step="0.01">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-file-text"></i> Giới thiệu
                                    </label>
                                    <textarea class="form-control" name="bio" rows="4" placeholder="Nhập giới thiệu về bản thân...">{{ $doctor->bio }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Cập nhật thông tin
                                </button>
                            </form>
                        </div>

                        <!-- Change Password Tab -->
                        <div class="tab-pane fade" id="change-password">
                            <form method="POST" action="{{ route('doctor.profile.change-password') }}">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-lock"></i> Mật khẩu hiện tại <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                           name="current_password" required>
                                    @error('current_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-key"></i> Mật khẩu mới <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                           name="password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Tối thiểu 8 ký tự</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-key-fill"></i> Xác nhận mật khẩu mới <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" class="form-control" name="password_confirmation" required>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Đổi mật khẩu
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
        tab.addEventListener('shown.bs.tab', function (e) {
            const target = e.target.getAttribute('href');
            if (target === '#change-password') {
                window.location.hash = 'change-password';
            }
        });
    });

    if (window.location.hash === '#change-password') {
        const tab = document.querySelector('[href="#change-password"]');
        if (tab) {
            const tabInstance = new bootstrap.Tab(tab);
            tabInstance.show();
        }
    }
</script>
@endpush
@endsection
