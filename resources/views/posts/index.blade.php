@extends('layouts.app')

@section('title', 'Tin tức sức khỏe')

@section('content')
<div class="container py-4 px-3 px-md-4">
    <div class="text-center mb-5">
        <h1 class="fw-bold display-5 mb-3">Tin tức sức khỏe</h1>
        <p class="text-muted lead">Cập nhật thông tin y tế mới nhất</p>
    </div>

    <div class="row g-4">
        @forelse($posts as $post)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm hover-shadow">
                    @if($post->image)
                        <a href="{{ route('posts.show', $post->id) }}">
                            <img src="{{ asset('storage/' . $post->image) }}" 
                                 class="card-img-top" 
                                 alt="{{ $post->title }}"
                                 style="height: 200px; object-fit: cover;">
                        </a>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-dark">
                                {{ $post->title }}
                            </a>
                        </h5>
                        <p class="card-text text-muted">{{ Str::limit(strip_tags($post->content), 150) }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <small class="text-muted">
                                <i class="bi bi-person"></i> {{ $post->author->name }}
                            </small>
                            <small class="text-muted">
                                <i class="bi bi-calendar"></i> {{ $post->created_at->format('d/m/Y') }}
                            </small>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-outline-primary">
                                Đọc thêm <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle"></i> Chưa có bài viết nào
                </div>
            </div>
        @endforelse
    </div>

    @if($posts->hasPages())
        <div class="mt-5">
            {{ $posts->links() }}
        </div>
    @endif
</div>

@push('styles')
<style>
    .hover-shadow {
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
    }
    .card-title a:hover {
        color: #667eea !important;
    }
</style>
@endpush
@endsection

