@extends('layouts.app')

@section('title', 'Quên mật khẩu')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <i class="bi bi-key display-1 text-primary"></i>
                        </div>
                        <h2 class="fw-bold mb-2">Quên mật khẩu</h2>
                        <p class="text-muted">Nhập email để nhận link đặt lại mật khẩu</p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle"></i> {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-4">
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
                            <small class="form-text text-muted">
                                Chúng tôi sẽ gửi link đặt lại mật khẩu đến email của bạn
                            </small>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                            <i class="bi bi-send"></i> Gửi link đặt lại mật khẩu
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
