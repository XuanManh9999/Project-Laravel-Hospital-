@extends('layouts.app')

@section('title', 'Chi tiết Lịch hẹn')

@section('content')
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Chi tiết Lịch hẹn #{{ $appointment->id }}</h2>
        <a href="{{ route('patient.history') }}" class="btn btn-secondary">Quay lại</a>
    </div>

    <div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Bác sĩ:</strong> {{ $appointment->doctor->user->name }}</p>
                <p><strong>Dịch vụ:</strong> {{ $appointment->service->name }}</p>
                <p><strong>Ngày hẹn:</strong> {{ $appointment->appointment_date->format('d/m/Y') }}</p>
                <p><strong>Ca khám:</strong> {{ $appointment->shift_label }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Trạng thái:</strong> 
                    <span class="badge bg-{{ $appointment->status == 'accepted' ? 'success' : ($appointment->status == 'waiting_examination' ? 'info' : ($appointment->status == 'rejected' ? 'danger' : ($appointment->status == 'completed' ? 'primary' : ($appointment->status == 'cancelled' ? 'secondary' : 'warning')))) }}">
                        @if($appointment->status == 'pending') Chờ xử lý
                        @elseif($appointment->status == 'accepted') Đã chấp nhận
                        @elseif($appointment->status == 'waiting_examination') Chờ khám
                        @elseif($appointment->status == 'rejected') Đã từ chối
                        @elseif($appointment->status == 'completed') Hoàn thành
                        @elseif($appointment->status == 'cancelled') Đã hủy
                        @else {{ $appointment->status }}
                        @endif
                    </span>
                </p>
                <p><strong>Thanh toán:</strong> 
                    <span class="badge bg-{{ $appointment->payment_status == 'paid' ? 'success' : 'secondary' }}">
                        {{ $appointment->payment_status == 'paid' ? 'Đã thanh toán' : 'Chưa thanh toán' }}
                    </span>
                </p>
                @if($appointment->notes)
                    <p><strong>Ghi chú:</strong> {{ $appointment->notes }}</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="d-flex gap-2 flex-wrap">
            @if(in_array($appointment->status, ['pending','accepted','waiting_examination']))
                <form method="POST" action="{{ route('patient.appointments.cancel', $appointment->id) }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn hủy lịch hẹn này?')">
                        <i class="bi bi-x-circle"></i> Hủy lịch hẹn
                    </button>
                </form>
            @endif

            @if($appointment->payment_status !== \App\Models\Appointment::PAYMENT_STATUS_PAID && in_array($appointment->status, ['pending','accepted']))
                <form method="POST" action="{{ route('vnpay.create', $appointment->id) }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-credit-card"></i> Thanh toán VNPay
                    </button>
                </form>
            @endif
        </div>

        @if($appointment->payment_status !== \App\Models\Appointment::PAYMENT_STATUS_PAID && in_array($appointment->status, ['pending','accepted']))
            <div class="alert alert-info mt-3 mb-0">
                <small>
                    Bạn sẽ được chuyển hướng tới cổng VNPay để hoàn tất thanh toán.
                    Sau khi thanh toán thành công, trạng thái sẽ được cập nhật tự động.
                </small>
            </div>
        @endif

        @if(in_array($appointment->status, ['pending','accepted','waiting_examination']) && $appointment->payment_status === 'paid')
            <div class="alert alert-info mt-3 mb-0">
                <small>
                    <i class="bi bi-info-circle"></i> Nếu bạn hủy lịch hẹn đã thanh toán, bạn sẽ nhận được email hướng dẫn liên hệ qua Zalo để hoàn tiền.
                </small>
            </div>
        @endif
    </div>
</div>
</div>
@endsection

