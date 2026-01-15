<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cổng thông tin Biển & Hải đảo Việt Nam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
    :root { 
        --primary-color: #0056b3; 
        --secondary-color: #f8f9fa; 
        --text-color: #333; 
        --red-highlight: #d9534f; 
    }
    body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: var(--text-color); background-color: #fff; }
    
    .site-header { 
        padding: 20px 0; 
        background-color: var(--primary-color); 
        background-image: url('https://www.transparenttextures.com/patterns/cubes.png'); 
        color: #fff; 
    }
    .site-title h1 { font-size: 1.5rem; font-weight: 800; text-transform: uppercase; color: #ffffff !important; margin: 0; }
    .site-title p { margin: 0; font-size: 0.9rem; color: #e0e0e0 !important; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }
    
    .navbar-main { background-color: var(--primary-color); box-shadow: none; border-top: 1px solid rgba(255, 255, 255, 0.1); }
    .navbar-main .nav-link { color: #fff !important; font-weight: 600; text-transform: uppercase; padding: 12px 18px !important; font-size: 0.95rem; }
    .navbar-main .nav-link:hover, .navbar-main .nav-link.active { background-color: #004494; color: #ffcc00 !important; }
    
    .section-title { border-bottom: 2px solid var(--primary-color); margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
    .section-title h3 { background: var(--primary-color); color: #fff; padding: 8px 15px; font-size: 1.1rem; text-transform: uppercase; margin-bottom: 0; font-weight: bold; display: inline-block; }
    
    .news-card { border: none; margin-bottom: 20px; transition: transform 0.2s; overflow: hidden; }
    .news-card:hover { transform: translateY(-3px); }
    .news-card img { border-radius: 4px; background-color: #eee; transition: 0.3s; }
    .news-card:hover img { transform: scale(1.05); }
    
    .news-title { font-size: 1.1rem; font-weight: bold; margin-top: 5px; line-height: 1.4; }
    .news-title a { text-decoration: none; color: #333; }
    .news-title a:hover { color: var(--primary-color); }
    .news-summary { font-size: 0.9rem; color: #666; margin-top: 5px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    
    .doc-list .list-group-item { border-left: none; border-right: none; padding: 12px 0; border-style: dashed; border-color: #ddd; }
    .doc-date { font-size: 0.8rem; color: #999; display: block; margin-bottom: 3px; }
    .doc-title { font-weight: 600; color: #333; text-decoration: none; font-size: 0.95rem; }
    .doc-title:hover { color: var(--primary-color); }
    
    /* Phân trang Bootstrap 5 */
    .pagination { margin-bottom: 0; gap: 5px; }
    .page-link { color: var(--primary-color); border-radius: 5px !important; border: 1px solid #dee2e6; }
    .page-item.active .page-link { background-color: var(--primary-color); border-color: var(--primary-color); }

    footer { background-color: #2c3e50; color: #ccc; padding-top: 40px; border-top: 5px solid #ffcc00; font-size: 0.9rem; }
    footer h5 { color: #fff; text-transform: uppercase; font-weight: bold; margin-bottom: 20px; border-left: 3px solid #ffcc00; padding-left: 10px; }
    footer a { color: #ccc; text-decoration: none; }
    .copyright { background: #1a252f; padding: 15px 0; margin-top: 30px; text-align: center; font-size: 0.85rem; }

    /* Tùy chỉnh phân trang */
.pagination {
    margin-top: 20px;
}
.page-item .page-link {
    color: #0056b3;
    padding: 8px 16px;
    border-radius: 4px;
    margin: 0 2px;
}
.page-item.active .page-link {
    background-color: #0056b3;
    border-color: #0056b3;
    color: white;
}

</style>
</head>
<body>

    <header class="site-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-auto">
                    <img src="{{ asset('images/vodic.gif') }}" alt="Logo" height="85">
                </div>
                <div class="col site-title">
                    <p>BỘ TÀI NGUYÊN VÀ MÔI TRƯỜNG</p>
                    <h1>CỔNG THÔNG TIN DỮ LIỆU BIỂN & HẢI ĐẢO</h1>
                </div>
            </div>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg navbar-main sticky-top">
        <div class="container">
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ !isset($currentCategory) && !isset($keyword) ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="fas fa-home"></i> Trang chủ
                        </a>
                    </li>
                    
                    @if(isset($categories))
                        @foreach($categories as $cat)
                            <li class="nav-item">
                                <a class="nav-link {{ (isset($currentCategory) && $currentCategory->id == $cat->id) ? 'active' : '' }}" 
                                   href="{{ route('category.show', $cat->id) }}">
                                    {{ $cat->name }}
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
                
                <div class="ms-auto">
                    @auth
                        <div class="dropdown">
                            <button class="btn btn-light text-primary fw-bold shadow-sm btn-sm rounded-pill px-3 dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-check"></i> {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Vào trang quản lý</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Đăng xuất</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-light text-primary fw-bold shadow-sm btn-sm rounded-pill px-3">
                            <i class="fas fa-user-shield"></i> Đăng nhập Cán bộ
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            
            <div class="col-lg-8">
                {{-- Slide: Chỉ hiện ở trang chủ, không hiện khi tìm kiếm hoặc xem danh mục --}}
                @if(!isset($currentCategory) && !isset($keyword) && isset($slides) && count($slides) > 0)
                <div id="newsCarousel" class="carousel slide mb-4 shadow rounded overflow-hidden bg-dark" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($slides as $key => $slide)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ $slide->image ? asset('storage/'.$slide->image) : asset('images/default-banner.jpg') }}" 
                                     class="d-block w-100" style="height: 400px; object-fit: cover;" alt="...">
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

                <div class="section-title">
                    <h3>
                        <i class="fas {{ isset($keyword) ? 'fa-search' : (isset($currentCategory) ? 'fa-folder-open' : 'fa-star') }} me-2"></i> 
                        @if(isset($keyword))
                            Kết quả tìm kiếm: "{{ $keyword }}"
                        @elseif(isset($currentCategory))
                            {{ $currentCategory->name }}
                        @else
                            Tin nổi bật
                        @endif
                    </h3>
                </div>

                @if(isset($posts) && $posts->count() > 0)
                    @foreach($posts as $post)
                    <div class="card news-card border-0 shadow-sm">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ $post->image ? asset('storage/'.$post->image) : asset('images/no-image.png') }}" 
                                     class="img-fluid rounded-start h-100 w-100" style="min-height: 180px; object-fit: cover;" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="news-title mt-0">
                                        <a href="{{ route('posts.show', $post->id) }}">
                                            {{ $post->title }}
                                        </a>
                                    </h5>
                                    <p class="text-muted small mb-1">
                                        <i class="far fa-clock"></i> {{ $post->created_at->format('d/m/Y') }} 
                                        - Tác giả: {{ $post->user->name ?? 'Ban Biên Tập' }}
                                    </p>
                                    <p class="news-summary text-secondary">{{ $post->summary }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    {{-- Phân trang chuẩn --}}
                    <div class="d-flex justify-content-center mt-4 mb-5">
                        {{ $posts->appends(request()->query())->links() }}
                    </div>
                @else
                    <div class="alert alert-info py-5 text-center shadow-sm">
                        <i class="fas fa-search fa-3x mb-3 text-muted"></i>
                        <p class="mb-0">Không tìm thấy bài viết nào phù hợp.</p>
                    </div>
                @endif
            </div>

            <div class="col-lg-4">
                {{-- Form tìm kiếm --}}
                <form action="{{ route('posts.search') }}" method="GET" class="mb-4 input-group shadow-sm">
                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm tin tức..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                </form>

                <div class="section-title">
                    <h3><i class="fas fa-bell me-2"></i> Thông báo</h3>
                </div>
                
                <div class="card border-0 shadow-sm mb-4">
                    <div class="list-group list-group-flush doc-list">
                        @if(isset($documents) && $documents->count() > 0)
                            @foreach($documents as $doc)
                                <div class="list-group-item">
                                    <span class="doc-date"><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($doc->created_at)->format('d/m/Y') }}</span>
                                    <a href="{{ $doc->link ?? '#' }}" class="doc-title">
                                        @if($doc->is_new)
                                            <span class="badge bg-danger">MỚI</span> 
                                        @endif
                                        {{ $doc->title }}
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <div class="p-3 text-center text-muted small">Không có thông báo mới</div>
                        @endif
                    </div>
                </div>

                <div class="section-title">
                    <h3><i class="fas fa-link me-2"></i> Liên kết</h3>
                </div>
                <select class="form-select mb-4 shadow-sm" onchange="if(this.value) window.open(this.value, '_blank')">
                    <option value="">-- Chọn liên kết Website --</option>
                    <option value="http://monre.gov.vn">Bộ Tài nguyên và Môi trường</option>
                    <option value="http://chinhphu.vn">Cổng TTĐT Chính phủ</option>
                </select>
    <div class="section-title mt-4">
    <h3><i class="fas fa-camera me-2"></i> Hình ảnh - Video</h3>
</div>
<div class="card border-0 shadow-sm overflow-hidden">
    <div class="ratio ratio-16x9">
        {{-- Lưu ý link đã được đổi thành /embed/ --}}
        <iframe src="https://www.youtube.com/embed/36BZOR9ypMk" 
                title="Toàn cảnh Bờ Biển Việt Nam - Nhìn từ trên cao" 
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                allowfullscreen>
        </iframe>
    </div>
    <div class="p-2">
        <small class="text-muted">Toàn cảnh Bờ Biển Việt Nam - Nhìn từ trên cao</small>
    </div>
</div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-5 mb-4">
                    <h5>CỤC BIỂN VÀ HẢI ĐẢO VIỆT NAM</h5>
                    <p><i class="fas fa-map-marker-alt me-2"></i> Số 83 Nguyễn Chí Thanh, Láng Hạ, Đống Đa, Hà Nội</p>
                    <p><i class="fas fa-envelope me-2"></i> webmaster@biendao.vn</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>LIÊN KẾT NHANH</h5>
                    <ul class="list-unstyled">
                        <li><a href="#"><i class="fas fa-angle-right me-1"></i> Giới thiệu</a></li>
                        <li><a href="#"><i class="fas fa-angle-right me-1"></i> Văn bản pháp luật</a></li>
                        <li><a href="#"><i class="fas fa-angle-right me-1"></i> Bản đồ số</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">Bản quyền © 2026 Cổng TTĐT Biển đảo Việt Nam.</div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>