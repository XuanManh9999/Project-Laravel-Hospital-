@extends('layouts.app')

@section('title', 'Lịch sử')

@section('content')
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Lịch sử lịch hẹn</h2>
    </div>

    <div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Bệnh nhân</th>
                        <th>Dịch vụ</th>
                        <th>Ngày giờ</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->patient->name }}</td>
                            <td>{{ $appointment->service->name }}</td>
                            <td>{{ $appointment->appointment_date->format('d/m/Y') }} - {{ $appointment->shift_label }}</td>
                            <td>
                                <span class="badge bg-{{ $appointment->status == 'completed' ? 'success' : 'secondary' }}">
                                    {{ $appointment->status == 'completed' ? 'Hoàn thành' : 'Đã hủy' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Không có dữ liệu</td>
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

