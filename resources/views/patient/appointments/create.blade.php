@extends('layouts.app')

@section('title', 'Đặt lịch hẹn')

@section('content')
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Đặt lịch hẹn với {{ $doctor->user->name }}</h2>
        <a href="{{ route('patient.doctors.show', $doctor->id) }}" class="btn btn-secondary">Quay lại</a>
    </div>

    <div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('patient.appointments.store') }}">
            @csrf
            <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">

            <div class="mb-3">
                <label class="form-label">Dịch vụ</label>
                <select name="service_id" class="form-select @error('service_id') is-invalid @enderror" required>
                    <option value="">Chọn dịch vụ</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                            {{ $service->name }} - {{ number_format($service->price, 0, ',', '.') }} đ
                        </option>
                    @endforeach
                </select>
                @error('service_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Ngày hẹn</label>
                    <input type="date" class="form-control @error('appointment_date') is-invalid @enderror" 
                           name="appointment_date" value="{{ old('appointment_date') }}" 
                           min="{{ \Carbon\Carbon::now()->addDays(3)->format('Y-m-d') }}"
                           max="{{ \Carbon\Carbon::now()->addWeeks(2)->format('Y-m-d') }}" required>
                    <small class="text-muted">Tối thiểu 3 ngày, tối đa 2 tuần</small>
                    @error('appointment_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Giờ hẹn</label>
                    <input type="time" class="form-control @error('appointment_time') is-invalid @enderror" 
                           name="appointment_time" value="{{ old('appointment_time') }}" required>
                    @error('appointment_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Ghi chú</label>
                <textarea class="form-control" name="notes" rows="3" placeholder="Mô tả triệu chứng hoặc yêu cầu...">{{ old('notes') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Đặt lịch hẹn</button>
        </form>
    </div>
</div>
</div>
@endsection

