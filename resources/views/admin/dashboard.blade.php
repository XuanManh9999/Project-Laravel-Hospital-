@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Dashboard</h2>
    </div>

    <div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <i class="bi bi-person-badge display-4 text-primary"></i>
                <h3 class="mt-3">{{ $stats['total_doctors'] }}</h3>
                <p class="text-muted mb-0">Tổng số bác sĩ</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <i class="bi bi-people display-4 text-success"></i>
                <h3 class="mt-3">{{ $stats['total_patients'] }}</h3>
                <p class="text-muted mb-0">Tổng số bệnh nhân</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <i class="bi bi-calendar-check display-4 text-info"></i>
                <h3 class="mt-3">{{ $stats['total_appointments'] }}</h3>
                <p class="text-muted mb-0">Tổng số lịch hẹn</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <i class="bi bi-clock-history display-4 text-warning"></i>
                <h3 class="mt-3">{{ $stats['pending_appointments'] }}</h3>
                <p class="text-muted mb-0">Lịch hẹn chờ xử lý</p>
            </div>
        </div>
    </div>
@endsection

