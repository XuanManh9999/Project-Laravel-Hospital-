@extends('layouts.app')

@section('title', 'Quản lý Hoàn tiền')

@section('content')
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Quản lý Hoàn tiền</h2>
    </div>

    <div class="card">
    <div class="card-body">
        <form method="GET" class="mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm bệnh nhân, lý do..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">Tất cả trạng thái</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                        <option value="processed" {{ request('status') == 'processed' ? 'selected' : '' }}>Đã xử lý</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Đã từ chối</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}" placeholder="Từ ngày">
                </div>
                <div class="col-md-2">
                    <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}" placeholder="Đến ngày">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Tìm kiếm
                    </button>
                </div>
                <div class="col-md-1">
                    @if(request()->hasAny(['search', 'status', 'date_from', 'date_to']))
                        <a href="{{ route('admin.refunds.index') }}" class="btn btn-outline-secondary w-100" title="Xóa bộ lọc">
                            <i class="bi bi-x-circle"></i>
                        </a>
                    @endif
                </div>
            </div>
        </form>

        <form method="POST" action="{{ route('admin.refunds.bulk-action') }}">
            @csrf
            <div class="row g-3 mb-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label mb-1">Thao tác hàng loạt</label>
                    <select name="action" class="form-select" required>
                        <option value="">-- Chọn thao tác --</option>
                        <option value="process">Xử lý hoàn tiền</option>
                        <option value="reject">Từ chối hoàn tiền</option>
                    </select>
                </div>
                <div class="col-md-5">
                    <label class="form-label mb-1">Lý do (khi từ chối)</label>
                    <input type="text" name="reason_bulk" class="form-control" placeholder="Lý do từ chối (tùy chọn)">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="bi bi-play-circle"></i> Thực hiện
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="select-all-refunds">
                            </th>
                            <th>ID</th>
                            <th>Lịch hẹn</th>
                            <th>Bệnh nhân</th>
                            <th>Số tiền</th>
                            <th>Lý do</th>
                            <th>Trạng thái</th>
                            <th>Người xử lý</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($refunds as $refund)
                            <tr>
                                <td>
                                    @if($refund->status == 'pending')
                                        <input type="checkbox" name="ids[]" value="{{ $refund->id }}" class="refund-checkbox">
                                    @endif
                                </td>
                                <td>{{ $refund->id }}</td>
                                <td>#{{ $refund->appointment->id }}</td>
                                <td>{{ $refund->appointment->patient->name }}</td>
                                <td>{{ number_format($refund->amount, 0, ',', '.') }} đ</td>
                                <td>{{ Str::limit($refund->reason, 50) }}</td>
                                <td>
                                    <span class="badge bg-{{ $refund->status == 'processed' ? 'success' : ($refund->status == 'rejected' ? 'danger' : 'warning') }}">
                                        @if($refund->status == 'pending') Chờ xử lý
                                        @elseif($refund->status == 'processed') Đã xử lý
                                        @else Đã từ chối
                                        @endif
                                    </span>
                                </td>
                                <td>{{ $refund->processor ? $refund->processor->name : '-' }}</td>
                                <td>
                                    @if($refund->status == 'pending')
                                        <form action="{{ route('admin.refunds.process', $refund->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <i class="bi bi-check"></i> Xử lý
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.refunds.reject', $refund->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-x"></i> Từ chối
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Không có dữ liệu</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </form>

        @if($refunds->hasPages())
            <div class="mt-4">
                {{ $refunds->links() }}
            </div>
        @endif
    </div>
</div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectAll = document.getElementById('select-all-refunds');
            if (!selectAll) return;

            const checkboxes = document.querySelectorAll('.refund-checkbox');

            selectAll.addEventListener('change', function () {
                checkboxes.forEach(cb => cb.checked = selectAll.checked);
            });
        });
    </script>
@endpush
@endsection

