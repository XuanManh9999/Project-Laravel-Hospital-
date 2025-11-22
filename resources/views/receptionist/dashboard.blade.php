@extends('layouts.app')

@section('title', 'Dashboard Tiếp viên')

@section('content')
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Dashboard</h2>
    </div>

    <div class="card">
    <div class="card-header">
        <h5>Lịch hẹn hôm nay</h5>
    </div>
    <div class="card-body">
        @if($todayAppointments->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Bệnh nhân</th>
                            <th>Bác sĩ</th>
                            <th>Dịch vụ</th>
                            <th>Thời gian</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($todayAppointments as $appointment)
                            <tr>
                                <td>{{ $appointment->patient->name }}</td>
                                <td>{{ $appointment->doctor->user->name }}</td>
                                <td>{{ $appointment->service->name }}</td>
                                <td>{{ $appointment->appointment_time }}</td>
                                <td>
                                    <span class="badge bg-{{ $appointment->status == 'accepted' ? 'success' : 'warning' }}">
                                        {{ $appointment->status == 'accepted' ? 'Đã chấp nhận' : 'Chờ xử lý' }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">Không có lịch hẹn nào hôm nay.</p>
        @endif
    </div>
</div>
</div>
@endsection

