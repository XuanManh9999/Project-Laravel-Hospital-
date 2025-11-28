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
                            <th>Trạng thái</th>
                            <th>Thanh toán</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($todayAppointments as $appointment)
                            <tr>
                                <td>{{ $appointment->patient->name }}</td>
                                <td>{{ $appointment->service->name }}</td>
                                <td>{{ $appointment->shift_label }}</td>
                                <td>
                                    <span class="badge bg-{{ $appointment->status == 'accepted' ? 'success' : ($appointment->status == 'waiting_examination' ? 'info' : 'primary') }}">
                                        @if($appointment->status == 'accepted') Đã chấp nhận
                                        @elseif($appointment->status == 'waiting_examination') Chờ khám
                                        @else Hoàn thành
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $appointment->payment_status === 'paid' ? 'success' : 'secondary' }}">
                                        @if($appointment->payment_status === 'paid')
                                            Đã thanh toán
                                        @elseif($appointment->payment_status === 'refunded')
                                            Đã hoàn tiền
                                        @else
                                            Chưa thanh toán
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    @if($appointment->status == 'accepted')
                                        <form action="{{ route('doctor.appointments.complete', $appointment->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                <i class="bi bi-check2-circle"></i> Hoàn tất
                                            </button>
                                        </form>
                                        <form action="{{ route('doctor.appointments.start-examination', $appointment->id) }}" method="POST" class="d-inline ms-1">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-info">
                                                <i class="bi bi-clock"></i> Chờ khám
                                            </button>
                                        </form>
                                    @elseif($appointment->status == 'waiting_examination')
                                        <form action="{{ route('doctor.appointments.complete', $appointment->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                <i class="bi bi-check2-circle"></i> Hoàn tất
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('doctor.appointments.show', $appointment->id) }}" class="btn btn-sm btn-outline-primary ms-1">
                                        <i class="bi bi-eye"></i> Xem
                                    </a>
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

