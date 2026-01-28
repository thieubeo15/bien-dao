@extends('layouts.site')
<style>
    /* ... các style cũ ... */

    /* CĂN GIỮA ẢNH */
    .content-body figure.image {
        display: table !important; /* Giúp khung ảnh co lại vừa vặn */
        margin-left: auto !important;
        margin-right: auto !important;
        margin-top: 15px;
        margin-bottom: 15px;
        clear: both; /* Ngắt dòng để ảnh đứng 1 mình */
    }

    .content-body img {
        display: block;
        margin: 0 auto;
        max-width: 100%;
        height: auto;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Đổ bóng nhẹ cho đẹp */
    }
    
    /* Căn giữa chú thích ảnh */
    .content-body figcaption {
        text-align: center;
        font-style: italic;
        color: #777;
        margin-top: 8px;
    }
</style>
@section('content')
{{-- Nút Quay lại --}}
<div class="mb-4">
    <a href="{{ route('home') }}" class="text-decoration-none fw-bold text-primary d-inline-flex align-items-center">
        <i class="fas fa-arrow-left me-2"></i> Quay lại trang chủ
    </a>
</div>

{{-- NỘI DUNG BÀI VIẾT (Thẻ trắng) --}}
{{-- Không cần <div class="row"> hay <div class="col-lg-8"> nữa vì Layout đã lo rồi --}}
<div class="bg-white p-4 p-md-5 rounded shadow-sm border mb-5">
    
    {{-- 1. Tiêu đề lớn --}}
    <h1 class="fw-bold text-dark mb-3" style="font-size: 2rem; line-height: 1.3;">
        {{ $post->title }}
    </h1>

    {{-- 2. Thông tin tác giả --}}
    <div class="d-flex align-items-center text-muted small mb-4 pb-3 border-bottom">
        <span class="fw-bold me-2 text-dark">
            <i class="fas fa-user-edit me-1"></i> {{ $post->user->name ?? 'Ban biên tập' }}
        </span>
        <span class="mx-2">•</span>
        <span><i class="far fa-clock me-1"></i> {{ $post->created_at->format('d/m/Y H:i') }}</span>
    </div>

    {{-- 3. Hình ảnh --}}
    @if($post->image)
        <div class="mb-4">
            <img src="{{ asset('storage/' . $post->image) }}" 
                 alt="{{ $post->title }}" 
                 class="w-100 rounded shadow-sm center-block"
                 style="object-fit: cover;">
            {{-- <p class="text-center text-muted small mt-2 fst-italic">Hình ảnh minh họa bài viết</p> --}}
        </div>
    @endif

    {{-- 4. Tóm tắt --}}
    <div class="p-3 mb-4 bg-light border-start border-4 border-primary rounded-end">
        <p class="fs-5 text-secondary fst-italic mb-0" style="font-family: serif;">
            {{ $post->summary }}
        </p>
    </div>

    {{-- 5. Nội dung chính --}}
    <div class="content-body" style="font-size: 1.1rem; line-height: 1.8; text-align: justify;">
        <div class="content-body">
    {!! $post->content !!}
</div>
    </div>

    {{-- Nút chia sẻ --}}
    <div class="mt-5 pt-3 border-top d-flex gap-2">
        <button class="btn btn-sm btn-outline-primary"><i class="fab fa-facebook"></i> Chia sẻ</button>
        <button class="btn btn-sm btn-outline-info"><i class="fab fa-twitter"></i> Tweet</button>
    </div>
</div>

{{-- BÀI VIẾT LIÊN QUAN --}}
@if(isset($relatedPosts) && $relatedPosts->count() > 0)
<div class="mb-5">
    <h4 class="fw-bold mb-3 border-bottom pb-2 border-primary d-inline-block text-uppercase">
        Bài viết liên quan
    </h4>
    <div class="row">
        @foreach($relatedPosts as $rel)
        <div class="col-md-6 mb-3">
            <div class="d-flex gap-3 bg-white p-3 rounded border shadow-sm h-100">
                @if($rel->image)
                    <img src="{{ asset('storage/'.$rel->image) }}" class="rounded" style="width: 80px; height: 60px; object-fit: cover;">
                @endif
                <div>
                    <h6 class="mb-1" style="font-size: 0.95rem;">
                        <a href="{{ route('posts.show', $rel->id) }}" class="text-decoration-none text-dark fw-bold">
                            {{ Str::limit($rel->title, 40) }}
                        </a>
                    </h6>
                    <small class="text-muted" style="font-size: 0.8rem;">
                        {{ $rel->created_at->format('d/m/Y') }}
                    </small>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

@endsection