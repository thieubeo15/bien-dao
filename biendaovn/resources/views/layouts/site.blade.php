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
    
    .pagination { margin-top: 20px; gap: 5px; }
    .page-item .page-link { color: #0056b3; padding: 8px 16px; border-radius: 4px; margin: 0 2px; }
    .page-item.active .page-link { background-color: #0056b3; border-color: #0056b3; color: white; }

    footer { background-color: #2c3e50; color: #ccc; padding-top: 40px; border-top: 5px solid #ffcc00; font-size: 0.9rem; }
    footer h5 { color: #fff; text-transform: uppercase; font-weight: bold; margin-bottom: 20px; border-left: 3px solid #ffcc00; padding-left: 10px; }
    footer a { color: #ccc; text-decoration: none; }
    footer a:hover { color: #fff; }
    .copyright { background: #1a252f; padding: 15px 0; margin-top: 30px; text-align: center; font-size: 0.85rem; }
    </style>
</head>
<body>
    @include('layouts.partials.header')
    @include('layouts.partials.navbar')
    @include('layouts.partials.ticker')

    <div class="container mt-4">
        <div class="row">
            {{-- Chèn ô tìm kiếm dùng chung nếu muốn --}}
             <form action="{{ route('posts.search') }}" method="GET" class="mb-4 input-group shadow-sm" >
                <input type="text" name="search" style="max-width: 850px;" class="form-control" placeholder="Tìm kiếm tin tức..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
            </form>

            <div class="col-lg-8">
                @yield('content')
            </div>

            <div class="col-lg-4">
                @include('layouts.partials.sidebar')
            </div>
        </div>
    </div>

    @include('layouts.partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>