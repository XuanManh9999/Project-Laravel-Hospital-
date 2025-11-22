@extends('layouts.app')

@section('title', 'Đặt lại mật khẩu')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <i class="bi bi-shield-lock display-1 text-primary"></i>
                        </div>
                        <h2 class="fw-bold mb-2">Đặt lại mật khẩu</h2>
                        <p class="text-muted">Nhập mật khẩu mới của bạn</p>
                    </div>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">
                                <i class="bi bi-envelope"></i> Email
                            </label>
                            <input type="email" 
                                   class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ $email ?? old('email') }}" 
                                   required 
                                   autofocus
                                   readonly>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">
                                <i class="bi bi-lock"></i> Mật khẩu mới <span class="text-danger">*</span>
                            </label>
                            <input type="password" 
                                   class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password" 
                                   placeholder="Tối thiểu 8 ký tự"
                                   required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold">
                                <i class="bi bi-lock-fill"></i> Xác nhận mật khẩu <span class="text-danger">*</span>
                            </label>
                            <input type="password" 
                                   class="form-control form-control-lg" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   placeholder="Nhập lại mật khẩu"
                                   required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                            <i class="bi bi-check-circle"></i> Đặt lại mật khẩu
                        </button>

                        <div class="text-center">
                            <a href="{{ route('login') }}" class="text-decoration-none">
                                <i class="bi bi-arrow-left"></i> Quay lại đăng nhập
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
