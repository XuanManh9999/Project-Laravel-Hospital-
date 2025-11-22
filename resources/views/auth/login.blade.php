@extends('layouts.app')

@section('title', 'Đăng nhập')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <i class="bi bi-hospital display-1 text-primary"></i>
                        </div>
                        <h2 class="fw-bold mb-2">Đăng nhập</h2>
                        <p class="text-muted">Hệ thống Quản lý Bệnh viện</p>
                    </div>

                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">
                                <i class="bi bi-envelope"></i> Email
                            </label>
                            <input type="email" 
                                   class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   placeholder="Nhập email của bạn"
                                   required 
                                   autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">
                                <i class="bi bi-lock"></i> Mật khẩu
                            </label>
                            <input type="password" 
                                   class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password" 
                                   placeholder="Nhập mật khẩu"
                                   required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">
                                Ghi nhớ đăng nhập
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                            <i class="bi bi-box-arrow-in-right"></i> Đăng nhập
                        </button>

                        <div class="text-center mb-3">
                            <a href="{{ route('password.request') }}" class="text-decoration-none">
                                <i class="bi bi-question-circle"></i> Quên mật khẩu?
                            </a>
                        </div>

                        <hr class="my-4">

                        <div class="text-center">
                            <p class="mb-0 text-muted">Chưa có tài khoản?</p>
                            <a href="{{ route('register') }}" class="btn btn-outline-primary w-100 mt-2">
                                <i class="bi bi-person-plus"></i> Đăng ký ngay
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Demo Accounts Info -->
            <div class="card border-0 shadow-sm mt-3">
                <div class="card-body">
                    <small class="text-muted">
                        <strong>Demo:</strong> admin@hospital.com / password
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
