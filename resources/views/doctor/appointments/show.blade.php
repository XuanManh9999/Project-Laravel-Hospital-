@extends('layouts.app')

@section('title', 'Chi tiết lịch hẹn')

@section('content')
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Chi tiết Lịch hẹn #{{ $appointment->id }}</h2>
        <a href="{{ route('doctor.appointments.index') }}" class="btn btn-secondary">Quay lại</a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Bệnh nhân:</strong> {{ $appointment->patient->name }}</p>
                    <p><strong>Email:</strong> {{ $appointment->patient->email }}</p>
                    <p><strong>Dịch vụ:</strong> {{ $appointment->service->name }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Ngày hẹn:</strong> {{ $appointment->appointment_date->format('d/m/Y') }}</p>
                    <p><strong>Ca khám:</strong> {{ $appointment->shift_label }}</p>
                    <p><strong>Trạng thái:</strong>
                        <span class="badge bg-{{ $appointment->status == 'accepted' ? 'success' : ($appointment->status == 'waiting_examination' ? 'info' : ($appointment->status == 'rejected' ? 'danger' : ($appointment->status == 'completed' ? 'primary' : ($appointment->status == 'cancelled' ? 'secondary' : 'warning')))) }}">
                            @if($appointment->status == 'pending') Chờ xử lý
                            @elseif($appointment->status == 'accepted') Đã chấp nhận
                            @elseif($appointment->status == 'waiting_examination') Chờ khám
                            @elseif($appointment->status == 'rejected') Đã từ chối
                            @elseif($appointment->status == 'cancelled') Đã hủy
                            @elseif($appointment->status == 'completed') Hoàn thành
                            @else {{ $appointment->status }}
                            @endif
                        </span>
                    </p>
                    <p><strong>Thanh toán:</strong>
                        <span class="badge bg-{{ $appointment->payment_status === 'paid' ? 'success' : 'secondary' }}">
                            @if($appointment->payment_status === 'paid')
                                Đã thanh toán
                            @elseif($appointment->payment_status === 'refunded')
                                Đã hoàn tiền
                            @else
                                Chưa thanh toán
                            @endif
                        </span>
                    </p>
                </div>
            </div>
            @if($appointment->notes)
                <hr>
                <p><strong>Ghi chú của bệnh nhân:</strong></p>
                <p class="mb-0">{{ $appointment->notes }}</p>
            @endif
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="mb-3">Thao tác</h5>
            @if($appointment->status === \App\Models\Appointment::STATUS_PENDING)
                <form action="{{ route('doctor.appointments.accept', $appointment->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check"></i> Chấp nhận
                    </button>
                </form>
                <form action="{{ route('doctor.appointments.reject', $appointment->id) }}" method="POST" class="d-inline ms-2">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-x"></i> Từ chối
                    </button>
                </form>
            @elseif($appointment->status === \App\Models\Appointment::STATUS_ACCEPTED)
                <form action="{{ route('doctor.appointments.complete', $appointment->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check2-circle"></i> Hoàn tất
                    </button>
                </form>
                @if($appointment->appointment_date->isToday() || $appointment->appointment_date->isPast())
                    <form action="{{ route('doctor.appointments.start-examination', $appointment->id) }}" method="POST" class="d-inline ms-2">
                        @csrf
                        <button type="submit" class="btn btn-info">
                            <i class="bi bi-clock"></i> Chờ khám
                        </button>
                    </form>
                @endif
            @elseif($appointment->status === \App\Models\Appointment::STATUS_WAITING_EXAMINATION)
                <form action="{{ route('doctor.appointments.complete', $appointment->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check2-circle"></i> Hoàn tất
                    </button>
                </form>
            @else
                <p class="text-muted mb-0">Lịch hẹn đã ở trạng thái cuối, không còn thao tác nào.</p>
            @endif
        </div>
    </div>
</div>
@endsection


