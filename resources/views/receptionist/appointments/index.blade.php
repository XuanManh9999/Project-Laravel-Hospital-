@extends('layouts.app')

@section('title', 'Lịch hẹn')

@section('content')
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Lịch hẹn phòng khám</h2>
    </div>

        <div class="card">
        <div class="card-body">
        <form method="GET" class="mb-3">
            <div class="row g-3">
                <div class="col-md-3">
                    <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">Tất cả trạng thái</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                        <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Đã chấp nhận</option>
                        <option value="waiting_examination" {{ request('status') == 'waiting_examination' ? 'selected' : '' }}>Chờ khám</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Đã từ chối</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="text" name="patient_name" class="form-control" placeholder="Tìm theo tên bệnh nhân" value="{{ request('patient_name') }}">
                </div>
                <div class="col-md-3">
                    <input type="text" name="doctor_name" class="form-control" placeholder="Tìm theo tên bác sĩ" value="{{ request('doctor_name') }}">
                </div>
            </div>
            <div class="row g-3 mt-2">
                <div class="col-md-2 ms-auto">
                    <button type="submit" class="btn btn-primary w-100">Lọc</button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Bệnh nhân</th>
                        <th>Bác sĩ</th>
                        <th>Dịch vụ</th>
                        <th>Ngày giờ</th>
                        <th>Trạng thái</th>
                        <th>Thanh toán</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->patient->name }}</td>
                            <td>{{ $appointment->doctor->user->name }}</td>
                            <td>{{ $appointment->service->name }}</td>
                            <td>{{ $appointment->appointment_date->format('d/m/Y') }} - {{ $appointment->shift_label }}</td>
                            <td>
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
                            </td>
                            <td>
                                <span class="badge bg-{{ $appointment->payment_status === 'paid' ? 'success' : ($appointment->payment_status === 'refunded' ? 'info' : 'secondary') }}">
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
                                <a href="{{ route('receptionist.appointments.show', $appointment->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> Xem chi tiết
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Không có dữ liệu</td>
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

