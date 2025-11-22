@extends('layouts.app')

@section('title', 'Lịch sử Lịch hẹn')

@section('content')
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Lịch sử Lịch hẹn</h2>
        <a href="{{ route('patient.doctors.index') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Đặt lịch mới
        </a>
    </div>

    <div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
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
                            <td>#{{ $appointment->id }}</td>
                            <td>{{ $appointment->doctor->user->name }}</td>
                            <td>{{ $appointment->service->name }}</td>
                            <td>{{ $appointment->appointment_date->format('d/m/Y') }} {{ $appointment->appointment_time }}</td>
                            <td>
                                <span class="badge bg-{{ $appointment->status == 'accepted' ? 'success' : ($appointment->status == 'rejected' ? 'danger' : 'warning') }}">
                                    @if($appointment->status == 'pending') Chờ xử lý
                                    @elseif($appointment->status == 'accepted') Đã chấp nhận
                                    @elseif($appointment->status == 'rejected') Đã từ chối
                                    @elseif($appointment->status == 'cancelled') Đã hủy
                                    @else Hoàn thành
                                    @endif
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $appointment->payment_status == 'paid' ? 'success' : 'secondary' }}">
                                    {{ $appointment->payment_status == 'paid' ? 'Đã thanh toán' : 'Chưa thanh toán' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('patient.appointments.show', $appointment->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-eye"></i>
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
@endsection

