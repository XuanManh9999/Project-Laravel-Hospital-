@extends('layouts.app')

@section('title', 'Thêm dịch vụ')

@section('content')
<div class="container py-4 px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Thêm dịch vụ</h2>
    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Quay lại</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.services.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Tên dịch vụ</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Giá (VNĐ)</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" 
                           name="price" value="{{ old('price') }}" min="0" step="1000" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Thời gian (phút)</label>
                    <input type="number" class="form-control @error('duration') is-invalid @enderror" 
                           name="duration" value="{{ old('duration') }}" min="1" required>
                    @error('duration')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="status" class="form-select" required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Hoạt động</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Tạm dừng</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Thêm dịch vụ</button>
        </form>
    </div>
</div>
</div>
@endsection

