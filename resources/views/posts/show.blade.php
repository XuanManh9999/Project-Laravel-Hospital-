@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="container py-4 px-3 px-md-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Tin tức</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($post->title, 50) }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <article class="card border-0 shadow-sm mb-4">
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" 
                         class="card-img-top" 
                         alt="{{ $post->title }}"
                         style="max-height: 400px; object-fit: cover;">
                @endif
                
                <div class="card-body p-4">
                    <h1 class="card-title mb-3 fw-bold">{{ $post->title }}</h1>
                    
                    <div class="d-flex flex-wrap align-items-center gap-3 mb-4 text-muted">
                        <div>
                            <i class="bi bi-person-circle"></i>
                            <strong>{{ $post->author->name }}</strong>
                        </div>
                        <div>
                            <i class="bi bi-calendar3"></i>
                            {{ $post->created_at->format('d/m/Y H:i') }}
                        </div>
                        <div>
                            <i class="bi bi-eye"></i>
                            Đã xem
                        </div>
                    </div>

                    <hr>

                    <div class="post-content">
                        {!! $post->content !!}
                    </div>

                    <!-- End content -->
                </div>
            </article>

            <!-- Related Posts -->
            @if($relatedPosts->count() > 0)
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-newspaper"></i> Bài viết liên quan
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            @foreach($relatedPosts as $relatedPost)
                                <div class="col-md-4">
                                    <div class="card border-0 h-100 hover-shadow">
                                        @if($relatedPost->image)
                                            <img src="{{ asset('storage/' . $relatedPost->image) }}" 
                                                 class="card-img-top" 
                                                 alt="{{ $relatedPost->title }}"
                                                 style="height: 150px; object-fit: cover;">
                                        @endif
                                        <div class="card-body">
                                            <h6 class="card-title">
                                                <a href="{{ route('posts.show', $relatedPost->id) }}" class="text-decoration-none">
                                                    {{ Str::limit($relatedPost->title, 60) }}
                                                </a>
                                            </h6>
                                            <small class="text-muted">
                                                <i class="bi bi-calendar"></i> {{ $relatedPost->created_at->format('d/m/Y') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Latest Posts -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-clock-history"></i> Bài viết mới nhất
                    </h5>
                </div>
                <div class="list-group list-group-flush">
                    @php
                        $latestPosts = \App\Models\Post::where('status', 'published')
                            ->where('id', '!=', $post->id)
                            ->with('author')
                            ->latest()
                            ->limit(5)
                            ->get();
                    @endphp
                    @forelse($latestPosts as $latestPost)
                        <a href="{{ route('posts.show', $latestPost->id) }}" 
                           class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">{{ Str::limit($latestPost->title, 50) }}</h6>
                            </div>
                            <small class="text-muted">
                                <i class="bi bi-calendar"></i> {{ $latestPost->created_at->format('d/m/Y') }}
                            </small>
                        </a>
                    @empty
                        <div class="list-group-item text-muted text-center">
                            Chưa có bài viết nào
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Back to list -->
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <a href="{{ route('posts.index') }}" class="btn btn-primary w-100">
                        <i class="bi bi-arrow-left"></i> Xem tất cả bài viết
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .post-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #333;
    }
    .post-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 20px 0;
    }
    .post-content p {
        margin-bottom: 1.5rem;
    }
    .post-content h1, .post-content h2, .post-content h3 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        font-weight: bold;
    }
    .post-content ul, .post-content ol {
        margin-bottom: 1.5rem;
        padding-left: 2rem;
    }
    .post-content a {
        color: #667eea;
        text-decoration: underline;
    }
    .post-content a:hover {
        color: #764ba2;
    }
    .hover-shadow {
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .hover-shadow:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1) !important;
    }
</style>
@endpush

@endsection

