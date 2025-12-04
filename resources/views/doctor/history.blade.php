@extends('layouts.app')

@section('title', 'Lịch sử lịch hẹn')

@section('content')
<div class="container py-4 px-3 px-md-4">
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        @if($doctor->avatar ?? false)
                            <img src="{{ $doctor->avatar }}" alt="{{ auth()->user()->name }}"
                                 class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover; border: 3px solid #0d6efd;">
                        @else
                            <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                                <i class="bi bi-person-badge display-4 text-primary"></i>
                            </div>
                        @endif
                    </div>
                    <h5 class="mb-1">{{ auth()->user()->name }}</h5>
                    <p class="text-muted small mb-0">{{ auth()->user()->email }}</p>
                    <span class="badge bg-success mt-2">Bác sĩ</span>
                </div>
            </div>

            <div class="card border-0 shadow-sm mt-3">
                <div class="list-group list-group-flush">
                    <a href="{{ route('doctor.profile') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-person me-2"></i> Thông tin cá nhân
                    </a>
                    <a href="{{ route('doctor.profile') }}#change-password" class="list-group-item list-group-item-action">
                        <i class="bi bi-key me-2"></i> Đổi mật khẩu
                    </a>
                    <a href="{{ route('doctor.appointments.index') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-calendar-check me-2"></i> Lịch hẹn của tôi
                    </a>
                    <a href="{{ route('doctor.history') }}" class="list-group-item list-group-item-action active">
                        <i class="bi bi-clock-history me-2"></i> Lịch sử lịch hẹn
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="bi bi-clock-history"></i> Lịch sử lịch hẹn
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Bệnh nhân</th>
                                    <th>Dịch vụ</th>
                                    <th>Ngày giờ</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($appointments as $appointment)
                                    <tr>
                                        <td>{{ $appointment->patient->name }}</td>
                                        <td>{{ $appointment->service->name }}</td>
                                        <td>{{ $appointment->appointment_date->format('d/m/Y') }} - {{ $appointment->shift_label }}</td>
                                        <td>
                                            <span class="badge bg-{{ $appointment->status == 'completed' ? 'success' : 'secondary' }}">
                                                {{ $appointment->status == 'completed' ? 'Hoàn thành' : 'Đã hủy' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Không có dữ liệu</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $appointments->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
