@extends('layouts.app')

@section('title', 'Chi tiết thanh toán')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h1 class="h3 fw-bold mb-1">Chi tiết thanh toán #{{ $payment->id }}</h1>
            <p class="text-muted mb-0">Thông tin chi tiết giao dịch và lịch hẹn liên quan</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.payments.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Danh sách thanh toán
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-semibold"><i class="bi bi-credit-card me-2"></i>Thông tin giao dịch</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Mã giao dịch</p>
                            <h6 class="fw-semibold">{{ $payment->transaction_id ?? '—' }}</h6>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Phương thức</p>
                            <span class="badge bg-light text-dark text-uppercase px-3 py-2">
                                {{ $payment->payment_method ?? 'Không xác định' }}
                            </span>
                        </div>
                        <div class="col-md-4">
                            <p class="text-muted mb-1">Số tiền</p>
                            <h5 class="fw-bold text-primary mb-0">{{ number_format($payment->amount, 0, ',', '.') }} đ</h5>
                        </div>
                        <div class="col-md-4">
                            <p class="text-muted mb-1">Trạng thái</p>
                            @php
                                $statusClass = match ($payment->status) {
                                    \App\Models\Payment::STATUS_SUCCESS => 'bg-success',
                                    \App\Models\Payment::STATUS_FAILED => 'bg-danger',
                                    default => 'bg-warning text-dark',
                                };
                                $statusLabel = match ($payment->status) {
                                    \App\Models\Payment::STATUS_SUCCESS => 'Thành công',
                                    \App\Models\Payment::STATUS_FAILED => 'Thất bại',
                                    default => 'Đang chờ',
                                };
                            @endphp
                            <span class="badge {{ $statusClass }} px-3 py-2">{{ $statusLabel }}</span>
                        </div>
                        <div class="col-md-4">
                            <p class="text-muted mb-1">Ngày tạo</p>
                            <h6 class="fw-semibold">{{ $payment->created_at->format('d/m/Y H:i') }}</h6>
                        </div>
                        <div class="col-md-12">
                            <p class="text-muted mb-1">Cập nhật lần cuối</p>
                            <h6 class="fw-semibold">{{ $payment->updated_at->format('d/m/Y H:i') }}</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-semibold"><i class="bi bi-journal-medical me-2"></i>Thông tin lịch hẹn</h5>
                    @if($payment->appointment)
                        <span class="badge bg-light text-dark">Mã lịch hẹn #{{ $payment->appointment->id }}</span>
                    @endif
                </div>
                <div class="card-body">
                    @if($payment->appointment)
                        <div class="row g-3">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Bệnh nhân</p>
                                <h6 class="fw-semibold mb-0">{{ optional($payment->appointment->patient)->name ?? 'Không xác định' }}</h6>
                                <small class="text-muted">{{ optional($payment->appointment->patient)->email }}</small>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Bác sĩ</p>
                                <h6 class="fw-semibold mb-0">{{ optional($payment->appointment->doctor?->user)->name ?? '—' }}</h6>
                                <small class="text-muted">{{ optional($payment->appointment->doctor?->user)->email }}</small>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Dịch vụ</p>
                                <h6 class="fw-semibold mb-0">{{ optional($payment->appointment->service)->name ?? '—' }}</h6>
                                <small class="text-muted">Phí khám: {{ optional($payment->appointment->service) ? number_format($payment->appointment->service->price, 0, ',', '.') . ' đ' : '—' }}</small>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Thời gian hẹn</p>
                                <h6 class="fw-semibold mb-0">
                                    {{ optional($payment->appointment->appointment_date)?->format('d/m/Y') }}
                                    - {{ $payment->appointment->shift_label }}
                                </h6>
                                <small class="text-muted text-capitalize">Trạng thái: {{ $payment->appointment->status }}</small>
                            </div>
                            <div class="col-md-12">
                                <p class="text-muted mb-1">Ghi chú</p>
                                <p class="mb-0">{{ $payment->appointment->notes ?? 'Không có ghi chú' }}</p>
                            </div>
                        </div>
                    @else
                        <p class="text-muted mb-0">Không tìm thấy dữ liệu lịch hẹn liên quan.</p>
                    @endif
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 fw-semibold"><i class="bi bi-code-slash me-2"></i>Phản hồi từ cổng thanh toán</h5>
                    @if($payment->vnpay_response)
                        <span class="badge bg-light text-dark">JSON</span>
                    @endif
                </div>
                <div class="card-body">
                    @if($payment->vnpay_response)
                        <pre class="bg-dark text-white rounded p-3 mb-0" style="max-height: 400px; overflow:auto;">
{{ json_encode($payment->vnpay_response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
                        </pre>
                    @else
                        <p class="text-muted mb-0">Không có phản hồi lưu trữ.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-semibold"><i class="bi bi-sliders me-2"></i>Cập nhật trạng thái</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.payments.update-status', $payment) }}">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label class="form-label">Trạng thái mới</label>
                            <select name="status" class="form-select">
                                <option value="pending" @selected($payment->status === \App\Models\Payment::STATUS_PENDING)>Đang chờ</option>
                                <option value="success" @selected($payment->status === \App\Models\Payment::STATUS_SUCCESS)>Thành công</option>
                                <option value="failed" @selected($payment->status === \App\Models\Payment::STATUS_FAILED)>Thất bại</option>
                            </select>
                        </div>
                        <div class="alert alert-light border">
                            <small class="text-muted d-block">• Khi chuyển sang <strong>Thành công</strong>, trạng thái thanh toán của lịch hẹn sẽ là "đã thanh toán".</small>
                            <small class="text-muted d-block mt-1">• Khi chuyển sang <strong>Thất bại</strong>, trạng thái thanh toán của lịch hẹn sẽ quay về "chờ thanh toán".</small>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-check-circle me-1"></i> Lưu thay đổi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

