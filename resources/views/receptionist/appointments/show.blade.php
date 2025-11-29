@extends('layouts.app')

@section('title', 'Chi tiết lịch hẹn')

@section('content')
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Chi tiết Lịch hẹn #{{ $appointment->id }}</h2>
        <a href="{{ route('receptionist.appointments.index') }}" class="btn btn-secondary">Quay lại</a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-3">Thông tin Bệnh nhân</h5>
                    <p><strong>Họ và tên:</strong> {{ $appointment->patient->name }}</p>
                    <p><strong>Email:</strong> {{ $appointment->patient->email }}</p>
                    @if($appointment->patient->phone)
                        <p><strong>Số điện thoại:</strong> {{ $appointment->patient->phone }}</p>
                    @endif
                    @if($appointment->patient->address)
                        <p><strong>Địa chỉ:</strong> {{ $appointment->patient->address }}</p>
                    @endif
                </div>
                <div class="col-md-6">
                    <h5 class="mb-3">Thông tin Bác sĩ</h5>
                    <p><strong>Họ và tên:</strong> {{ $appointment->doctor->user->name }}</p>
                    <p><strong>Chuyên khoa:</strong> {{ $appointment->doctor->specialization }}</p>
                    @if($appointment->doctor->user->phone)
                        <p><strong>Số điện thoại:</strong> {{ $appointment->doctor->user->phone }}</p>
                    @endif
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-3">Thông tin Lịch hẹn</h5>
                    <p><strong>Dịch vụ:</strong> {{ $appointment->service->name }}</p>
                    <p><strong>Ngày hẹn:</strong> {{ $appointment->appointment_date->format('d/m/Y') }}</p>
                    <p><strong>Ca khám:</strong> {{ $appointment->shift_label }}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="mb-3">Trạng thái</h5>
                    <p><strong>Trạng thái lịch hẹn:</strong>
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
                    <p><strong>Trạng thái thanh toán:</strong>
                        <span class="badge bg-{{ $appointment->payment_status === 'paid' ? 'success' : ($appointment->payment_status === 'refunded' ? 'info' : 'secondary') }}">
                            @if($appointment->payment_status === 'paid')
                                Đã thanh toán
                            @elseif($appointment->payment_status === 'refunded')
                                Đã hoàn tiền
                            @else
                                Chưa thanh toán
                            @endif
                        </span>
                    </p>
                    @if($appointment->payment)
                        <p><strong>Số tiền:</strong> {{ number_format($appointment->payment->amount, 0, ',', '.') }} đ</p>
                        <p><strong>Ngày thanh toán:</strong> {{ $appointment->payment->created_at->format('d/m/Y H:i') }}</p>
                    @endif
                </div>
            </div>
            @if($appointment->notes)
                <hr>
                <h5 class="mb-3">Ghi chú</h5>
                <p class="mb-0">{{ $appointment->notes }}</p>
            @endif
        </div>
    </div>
</div>
@endsection

