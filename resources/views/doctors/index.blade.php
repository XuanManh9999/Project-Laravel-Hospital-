@extends('layouts.app')

@section('title', 'Đội ngũ bác sĩ')

@section('content')
<div class="container py-4 px-3 px-md-4">
    <div class="mb-4 text-center">
        <h1 class="fw-bold display-5 mb-2">Đội ngũ bác sĩ</h1>
        <p class="text-muted lead mb-0">Danh sách đầy đủ các bác sĩ đang làm việc tại bệnh viện</p>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-4">
                @forelse($doctors as $doctor)
                    <div class="col-md-3">
                        <div class="card h-100 border-0 shadow-sm text-center hover-shadow">
                            <div class="card-body p-4">
                                <div class="mb-3">
                                    @if($doctor->avatar)
                                        <img src="{{ $doctor->avatar }}" alt="{{ $doctor->user->name }}"
                                             class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover; border: 3px solid #0d6efd;">
                                    @else
                                        <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                                            <i class="bi bi-person-circle display-4 text-primary"></i>
                                        </div>
                                    @endif
                                </div>
                                <h5 class="card-title">{{ $doctor->user->name }}</h5>
                                <p class="text-muted mb-2">
                                    <i class="bi bi-briefcase"></i> {{ $doctor->specialization }}
                                </p>
                                <p class="text-muted mb-2">
                                    <i class="bi bi-award"></i> {{ $doctor->experience }} năm kinh nghiệm
                                </p>
                                @if($doctor->qualification)
                                    <p class="text-muted small mb-2">
                                        <i class="bi bi-mortarboard"></i> {{ $doctor->qualification }}
                                    </p>
                                @endif
                                <p class="text-primary fw-bold mb-0">
                                    {{ number_format($doctor->consultation_fee, 0, ',', '.') }} đ
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center mb-0">Hiện chưa có bác sĩ nào.</div>
                    </div>
                @endforelse
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $doctors->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
