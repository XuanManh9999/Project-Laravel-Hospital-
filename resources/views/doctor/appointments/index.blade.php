@extends('layouts.app')

@section('title', 'Lịch hẹn')

@section('content')
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Lịch hẹn</h2>
    </div>

    <div class="card">
    <div class="card-body">
        <form method="GET" class="mb-3">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                </div>
                <div class="col-md-4">
                    <select name="status" class="form-select">
                        <option value="">Tất cả trạng thái</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                        <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Đã chấp nhận</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Đã từ chối</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Lọc</button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Bệnh nhân</th>
                        <th>Dịch vụ</th>
                        <th>Ngày giờ</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->patient->name }}</td>
                            <td>{{ $appointment->service->name }}</td>
                            <td>{{ $appointment->appointment_date->format('d/m/Y') }} {{ $appointment->appointment_time }}</td>
                            <td>
                                <span class="badge bg-{{ $appointment->status == 'accepted' ? 'success' : ($appointment->status == 'rejected' ? 'danger' : 'warning') }}">
                                    @if($appointment->status == 'pending') Chờ xử lý
                                    @elseif($appointment->status == 'accepted') Đã chấp nhận
                                    @else Đã từ chối
                                    @endif
                                </span>
                            </td>
                            <td>
                                @if($appointment->status == 'pending')
                                    <form action="{{ route('doctor.appointments.accept', $appointment->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="bi bi-check"></i> Chấp nhận
                                        </button>
                                    </form>
                                    <form action="{{ route('doctor.appointments.reject', $appointment->id) }}" method="POST" class="d-inline">
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
                            <td colspan="5" class="text-center">Không có dữ liệu</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $appointments->links() }}
    </div>
    </div>
</div>
@endsection

