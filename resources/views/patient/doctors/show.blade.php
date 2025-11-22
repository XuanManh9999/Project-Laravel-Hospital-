@extends('layouts.app')

@section('title', 'Chi tiết Bác sĩ')

@section('content')
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Chi tiết Bác sĩ</h2>
        <a href="{{ route('patient.doctors.index') }}" class="btn btn-secondary">Quay lại</a>
    </div>

    <div class="card mb-4">
    <div class="card-body">
        <h3>{{ $doctor->user->name }}</h3>
        <p class="text-muted mb-3">
            <i class="bi bi-briefcase"></i> {{ $doctor->specialization }}
        </p>
        <p class="text-muted mb-3">
            <i class="bi bi-award"></i> {{ $doctor->experience }} năm kinh nghiệm
        </p>
        @if($doctor->qualification)
            <p class="text-muted mb-3">
                <i class="bi bi-mortarboard"></i> {{ $doctor->qualification }}
            </p>
        @endif
        <p class="text-primary fw-bold mb-3">
            Phí tư vấn: {{ number_format($doctor->consultation_fee, 0, ',', '.') }} đ
        </p>
        @if($doctor->bio)
            <p>{{ $doctor->bio }}</p>
        @endif
        <hr>
        <p><strong>Email:</strong> {{ $doctor->user->email }}</p>
        @if($doctor->user->phone)
            <p><strong>Số điện thoại:</strong> {{ $doctor->user->phone }}</p>
        @endif
        @if($doctor->user->address)
            <p><strong>Địa chỉ:</strong> {{ $doctor->user->address }}</p>
        @endif
    </div>
</div>

<div class="text-center">
    <a href="{{ route('patient.appointments.create', $doctor->id) }}" class="btn btn-primary btn-lg">
        <i class="bi bi-calendar-plus"></i> Đặt lịch hẹn
    </a>
</div>
</div>
@endsection

