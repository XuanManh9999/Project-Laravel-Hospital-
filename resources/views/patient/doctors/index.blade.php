@extends('layouts.app')

@section('title', 'Danh sách Bác sĩ')

@section('content')
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Danh sách Bác sĩ</h2>
    </div>

    <div class="row g-4">
    @forelse($doctors as $doctor)
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $doctor->user->name }}</h5>
                    <p class="text-muted mb-2">
                        <i class="bi bi-briefcase"></i> {{ $doctor->specialization }}
                    </p>
                    <p class="text-muted mb-2">
                        <i class="bi bi-award"></i> {{ $doctor->experience }} năm kinh nghiệm
                    </p>
                    @if($doctor->qualification)
                        <p class="text-muted mb-2">
                            <i class="bi bi-mortarboard"></i> {{ $doctor->qualification }}
                        </p>
                    @endif
                    <p class="text-primary fw-bold mb-3">
                        Phí tư vấn: {{ number_format($doctor->consultation_fee, 0, ',', '.') }} đ
                    </p>
                    @if($doctor->bio)
                        <p class="card-text">{{ Str::limit($doctor->bio, 100) }}</p>
                    @endif
                    <a href="{{ route('patient.doctors.show', $doctor->id) }}" class="btn btn-primary w-100">
                        Xem chi tiết
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info">Không có bác sĩ nào.</div>
        </div>
    @endforelse
    </div>
</div>
@endsection

