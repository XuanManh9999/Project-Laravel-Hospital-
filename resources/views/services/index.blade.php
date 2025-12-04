@extends('layouts.app')

@section('title', 'Tất cả dịch vụ')

@section('content')
<div class="container py-4 px-3 px-md-4">
    <div class="mb-4 text-center">
        <h1 class="fw-bold display-5 mb-2">Tất cả dịch vụ</h1>
        <p class="text-muted lead mb-0">Danh sách đầy đủ các dịch vụ y tế đang cung cấp</p>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-4">
                @forelse($services as $service)
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm hover-shadow">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-heart-pulse text-danger fs-3 me-3"></i>
                                    <h5 class="card-title mb-0">{{ $service->name }}</h5>
                                </div>
                                <p class="card-text text-muted">{{ $service->description }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="text-primary fw-bold fs-5">{{ number_format($service->price, 0, ',', '.') }} đ</span>
                                    @if($service->duration)
                                        <small class="text-muted">
                                            <i class="bi bi-clock"></i> {{ $service->duration }} phút
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center mb-0">Hiện chưa có dịch vụ nào.</div>
                    </div>
                @endforelse
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $services->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
