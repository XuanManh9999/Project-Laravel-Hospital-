@extends('layouts.app')

@section('title', 'Dashboard Bệnh nhân')

@section('content')
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Dashboard</h2>
        <a href="{{ route('patient.doctors.index') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Đặt lịch hẹn
        </a>
    </div>

    <div class="card mb-4">
    <div class="card-header">
        <h5>Lịch hẹn sắp tới</h5>
    </div>
    <div class="card-body">
        @if($upcomingAppointments->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Bác sĩ</th>
                            <th>Dịch vụ</th>
                            <th>Ngày giờ</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($upcomingAppointments as $appointment)
                            <tr>
                                <td>{{ $appointment->doctor->user->name }}</td>
                                <td>{{ $appointment->service->name }}</td>
                                <td>{{ $appointment->appointment_date->format('d/m/Y') }} - {{ $appointment->shift_label }}</td>
                                <td>
                                    <span class="badge bg-success">Đã chấp nhận</span>
                                </td>
                                <td>
                                    <a href="{{ route('patient.appointments.show', $appointment->id) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">Bạn chưa có lịch hẹn nào.</p>
        @endif
    </div>
</div>
</div>
@endsection

