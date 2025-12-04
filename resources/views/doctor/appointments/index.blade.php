@extends('layouts.app')

@section('title', 'Lịch hẹn')

@section('content')
<div class="container py-4 px-3 px-md-4">
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        @if($doctor->avatar ?? false)
                            <img src="{{ $doctor->avatar }}" alt="{{ auth()->user()->name }}"
                                 class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover; border: 3px solid #0d6efd;">
                        @else
                            <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                                <i class="bi bi-person-badge display-4 text-primary"></i>
                            </div>
                        @endif
                    </div>
                    <h5 class="mb-1">{{ auth()->user()->name }}</h5>
                    <p class="text-muted small mb-0">{{ auth()->user()->email }}</p>
                    <span class="badge bg-success mt-2">Bác sĩ</span>
                </div>
            </div>

            <div class="card border-0 shadow-sm mt-3">
                <div class="list-group list-group-flush">
                    <a href="{{ route('doctor.profile') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-person me-2"></i> Thông tin cá nhân
                    </a>
                    <a href="{{ route('doctor.profile') }}#change-password" class="list-group-item list-group-item-action">
                        <i class="bi bi-key me-2"></i> Đổi mật khẩu
                    </a>
                    <a href="{{ route('doctor.appointments.index') }}" class="list-group-item list-group-item-action active">
                        <i class="bi bi-calendar-check me-2"></i> Lịch hẹn của tôi
                    </a>
                    <a href="{{ route('doctor.history') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-clock-history me-2"></i> Lịch sử lịch hẹn
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Lịch hẹn</h2>
            </div>

            <div class="card border-0 shadow-sm">
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
                                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Đã từ chối</option>
                                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="patient_name" class="form-control" placeholder="Tìm kiếm theo tên bệnh nhân" value="{{ request('patient_name') }}">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-search"></i> Lọc
                                </button>
                                @if(request()->hasAny(['date', 'status', 'patient_name']))
                                    <a href="{{ route('doctor.appointments.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                                        <i class="bi bi-x-circle"></i> Xóa lọc
                                    </a>
                                @endif
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
                                    <th>Thanh toán</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($appointments as $appointment)
                                    <tr>
                                        <td>{{ $appointment->patient->name }}</td>
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
                                            <div class="d-flex flex-wrap gap-2">
                                                <a href="{{ route('doctor.appointments.show', $appointment->id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-eye"></i> Xem
                                                </a>
                                                @if($appointment->status == 'pending')
                                                    <form action="{{ route('doctor.appointments.accept', $appointment->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-success">
                                                            <i class="bi bi-check"></i> Chấp nhận
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('doctor.appointments.reject', $appointment->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="bi bi-x"></i> Từ chối
                                                        </button>
                                                    </form>
                                                @elseif($appointment->status == 'accepted')
                                                    <form action="{{ route('doctor.appointments.complete', $appointment->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-primary">
                                                            <i class="bi bi-check2-circle"></i> Hoàn tất
                                                        </button>
                                                    </form>
                                                    @if($appointment->appointment_date->isToday() || $appointment->appointment_date->isPast())
                                                        <form action="{{ route('doctor.appointments.start-examination', $appointment->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-info">
                                                                <i class="bi bi-clock"></i> Chờ khám
                                                            </button>
                                                        </form>
                                                    @endif
                                                @elseif($appointment->status == 'waiting_examination')
                                                    <form action="{{ route('doctor.appointments.complete', $appointment->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-primary">
                                                            <i class="bi bi-check2-circle"></i> Hoàn tất
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Không có dữ liệu</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $appointments->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
