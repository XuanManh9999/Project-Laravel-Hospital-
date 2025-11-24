@extends('layouts.app')

@section('title', 'Quản lý thanh toán')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h1 class="h3 fw-bold mb-1">Quản lý thanh toán</h1>
            <p class="text-muted mb-0">Theo dõi toàn bộ giao dịch và trạng thái thanh toán</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Quay về Dashboard
        </a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Tổng giao dịch</p>
                    <h3 class="fw-bold mb-0">{{ number_format($stats['total']) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Thành công</p>
                    <h3 class="fw-bold text-success mb-0">{{ number_format($stats['success']) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Đang chờ</p>
                    <h3 class="fw-bold text-warning mb-0">{{ number_format($stats['pending']) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Thất bại</p>
                    <h3 class="fw-bold text-danger mb-0">{{ number_format($stats['failed']) }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold"><i class="bi bi-funnel me-2"></i>Bộ lọc &amp; tìm kiếm</h5>
            </div>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.payments.index') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label text-muted">Từ khóa (mã giao dịch, bệnh nhân, bác sĩ)</label>
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Nhập để tìm kiếm...">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label text-muted">Trạng thái</label>
                        <select name="status" class="form-select">
                            <option value="">Tất cả</option>
                            <option value="pending" @selected(request('status') === 'pending')>Đang chờ</option>
                            <option value="success" @selected(request('status') === 'success')>Thành công</option>
                            <option value="failed" @selected(request('status') === 'failed')>Thất bại</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label text-muted">Phương thức</label>
                        <select name="payment_method" class="form-select">
                            <option value="">Tất cả</option>
                            <option value="vnpay" @selected(request('payment_method') === 'vnpay')>VNPay</option>
                            <option value="cash" @selected(request('payment_method') === 'cash')>Tiền mặt</option>
                            <option value="bank_transfer" @selected(request('payment_method') === 'bank_transfer')>Chuyển khoản</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label text-muted">Từ ngày</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label text-muted">Đến ngày</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label text-muted">Số tiền tối thiểu</label>
                        <input type="number" name="amount_min" value="{{ request('amount_min') }}" class="form-control" min="0" step="1000">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label text-muted">Số tiền tối đa</label>
                        <input type="number" name="amount_max" value="{{ request('amount_max') }}" class="form-control" min="0" step="1000">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label text-muted">Sắp xếp</label>
                        <select name="sort" class="form-select">
                            <option value="">Mới nhất</option>
                            <option value="oldest" @selected(request('sort') === 'oldest')>Cũ nhất</option>
                            <option value="amount_desc" @selected(request('sort') === 'amount_desc')>Số tiền cao &darr;</option>
                            <option value="amount_asc" @selected(request('sort') === 'amount_asc')>Số tiền thấp &uarr;</option>
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search me-1"></i> Áp dụng
                        </button>
                        <a href="{{ route('admin.payments.index') }}" class="btn btn-light border w-100">
                            <i class="bi bi-arrow-repeat me-1"></i> Đặt lại
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Mã giao dịch</th>
                            <th>Bệnh nhân</th>
                            <th>Bác sĩ</th>
                            <th>Dịch vụ</th>
                            <th>Số tiền</th>
                            <th>Phương thức</th>
                            <th>Trạng thái</th>
                            <th>Thời gian</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $payment)
                            <tr>
                                <td>{{ $payment->id }}</td>
                                <td class="fw-semibold">{{ $payment->transaction_id ?? '—' }}</td>
                                <td>
                                    <div class="fw-semibold">{{ optional($payment->appointment?->patient)->name ?? 'Không xác định' }}</div>
                                    <small class="text-muted">{{ optional($payment->appointment?->patient)->email }}</small>
                                </td>
                                <td>{{ optional($payment->appointment?->doctor?->user)->name ?? '—' }}</td>
                                <td>{{ optional($payment->appointment?->service)->name ?? '—' }}</td>
                                <td class="fw-semibold text-primary">{{ number_format($payment->amount, 0, ',', '.') }} đ</td>
                                <td>
                                    <span class="badge bg-light text-dark text-uppercase">{{ $payment->payment_method ?? 'N/A' }}</span>
                                </td>
                                <td>
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
                                    <span class="badge {{ $statusClass }}">{{ $statusLabel }}</span>
                                </td>
                                <td>{{ $payment->created_at->format('d/m/Y H:i') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.payments.show', $payment) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i> Chi tiết
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-4 text-muted">
                                    <i class="bi bi-receipt-cutoff fs-4 d-block mb-2"></i>
                                    Chưa có giao dịch nào phù hợp bộ lọc.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($payments->hasPages())
            <div class="card-footer bg-white">
                {{ $payments->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

