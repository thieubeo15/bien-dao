@extends('layouts.site')

@section('content')

    {{-- 1. SLIDER (Giữ nguyên) --}}
    @if(!isset($currentCategory) && !isset($keyword) && isset($slides) && count($slides) > 0)
    <div id="newsCarousel" class="carousel slide mb-4 shadow rounded overflow-hidden bg-dark" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($slides as $key => $slide)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img src="{{ $slide->image ? asset('storage/'.$slide->image) : asset('images/default-banner.jpg') }}" 
                         class="d-block w-100" style="height: 400px; object-fit: cover;" alt="{{ $slide->title }}">
                    <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-75 rounded p-2">
                        <h5 class="m-0">{{ $slide->title }}</h5>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#newsCarousel" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
        <button class="carousel-control-next" type="button" data-bs-target="#newsCarousel" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
    </div>
    @endif

    {{-- 2. DANH SÁCH TIN MỚI / KẾT QUẢ TÌM KIẾM (Giữ nguyên logic cũ của bạn) --}}
    <div class="section-title">
        <h3>
            <i class="fas {{ isset($keyword) ? 'fa-search' : (isset($currentCategory) ? 'fa-folder-open' : 'fa-star') }} me-2"></i> 
            @if(isset($keyword))
                Kết quả tìm kiếm: "{{ $keyword }}"
            @elseif(isset($currentCategory))
                {{ $currentCategory->name }}
            @else
                Tin mới nhất
            @endif
        </h3>
    </div>

    @if(isset($posts) && $posts->count() > 0)
        @foreach($posts as $post)
        <div class="card news-card border-0 shadow-sm mb-3"> {{-- Thêm mb-3 để các thẻ cách nhau --}}
            <div class="row g-0">
                <div class="col-md-4">
                    <a href="{{ route('posts.show', $post->id) }}" class="d-block overflow-hidden rounded-start h-100">
                        <img src="{{ $post->image ? asset('storage/'.$post->image) : asset('images/no-image.png') }}" 
                             class="img-fluid h-100 w-100" 
                             style="min-height: 180px; object-fit: cover; transition: 0.3s;" 
                             alt="{{ $post->title }}">
                    </a>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="news-title mt-0">
                            <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-dark fw-bold">
                                {{ $post->title }}
                            </a>
                        </h5>
                        <p class="text-muted small mb-2">
                            <i class="far fa-clock"></i> {{ $post->created_at->format('d/m/Y') }} 
                            <span class="mx-1">•</span> 
                            {{ $post->user->name ?? 'Ban Biên Tập' }}
                        </p>
                        <p class="news-summary text-secondary mb-0" style="font-size: 0.95rem;">
                            {{ Str::limit($post->summary, 120) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="d-flex justify-content-center mt-4 mb-5">
            {{ $posts->appends(request()->query())->links() }}
        </div>
    @else
        <div class="alert alert-info py-5 text-center shadow-sm">
            <i class="fas fa-search fa-3x mb-3 text-muted"></i>
            <p class="mb-0">Không tìm thấy bài viết nào phù hợp.</p>
        </div>
    @endif

    {{-- ================================================================================= --}}
    {{-- 3. [MỚI] PHẦN HIỂN THỊ CÁC DANH MỤC (Mỗi danh mục 2 bài) --}}
    {{-- Chỉ hiện ở Trang chủ (không hiện khi tìm kiếm hoặc xem danh mục con) --}}
    {{-- ================================================================================= --}}
    @if(!isset($currentCategory) && !isset($keyword) && isset($categoriesWithPosts))
        
        <div class="mt-5 mb-4 border-top pt-4"></div> {{-- Đường kẻ phân cách --}}

        @foreach($categoriesWithPosts as $cat)
            {{-- Chỉ hiện danh mục nào CÓ bài viết --}}
            @if($cat->posts->count() > 0)
            <div class="category-section mb-5">
                
                {{-- Tiêu đề danh mục --}}
                <div class="d-flex justify-content-between align-items-center border-bottom border-primary border-2 mb-3 pb-2">
                    <h4 class="text-uppercase fw-bold text-primary m-0 fs-5">
                        <i class="fas fa-folder me-2"></i> {{ $cat->name }}
                    </h4>
                    <a href="{{ route('category.show', $cat->id) }}" class="text-decoration-none small text-muted">
                        Xem tất cả <i class="fas fa-angle-right"></i>
                    </a>
                </div>

                {{-- Lưới 2 bài viết --}}
                <div class="row">
                    @foreach($cat->posts as $p)
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="row g-0 h-100">
                                <div class="col-4 overflow-hidden">
                                    <a href="{{ route('posts.show', $p->id) }}" class="h-100 d-block">
                                        <img src="{{ $p->image ? asset('storage/'.$p->image) : asset('images/no-image.png') }}" 
                                             class="img-fluid h-100 w-100 object-fit-cover rounded-start" 
                                             alt="{{ $p->title }}">
                                    </a>
                                </div>
                                <div class="col-8">
                                    <div class="card-body p-2 d-flex flex-column h-100 justify-content-center">
                                        <h6 class="card-title mb-1" style="font-size: 0.95rem; line-height: 1.4;">
                                            <a href="{{ route('posts.show', $p->id) }}" class="text-decoration-none text-dark fw-bold">
                                                {{ Str::limit($p->title, 50) }}
                                            </a>
                                        </h6>
                                        <div class="small text-muted mb-2" style="font-size: 0.75rem;">
                                            {{ $p->created_at->format('d/m/Y') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        @endforeach
    @endif

@endsection