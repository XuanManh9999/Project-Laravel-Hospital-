@extends('layouts.app')

@section('title', 'Dashboard Bác sĩ')

@section('content')
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Dashboard</h2>
    </div>

    <div class="card mb-4">
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
                            <th>Dịch vụ</th>
                            <th>Thời gian</th>
                            <th>Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($todayAppointments as $appointment)
                            <tr>
                                <td>{{ $appointment->patient->name }}</td>
                                <td>{{ $appointment->service->name }}</td>
                                <td>{{ $appointment->appointment_time }}</td>
                                <td>{{ Str::limit($appointment->notes, 50) }}</td>
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

