<style>
.site-header {
    position: relative;
    padding: 28px 0;
    color: white;
    overflow: hidden;

    /* Gradient đại dương */
    background: linear-gradient(-45deg, #021B79, #0575E6, #00c6ff, #003973);
    background-size: 300% 300%;
    animation: oceanMove 12s ease infinite;
}

/* Chuyển động nền nước */
@keyframes oceanMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* Lớp ánh sáng mặt nước */
.site-header::before {
    content: "";
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 20% 20%, rgba(255,255,255,0.15), transparent 60%);
    animation: lightMove 8s linear infinite;
}

/* Hiệu ứng ánh sáng di chuyển */
@keyframes lightMove {
    0% { transform: translateX(-10%); }
    50% { transform: translateX(10%); }
    100% { transform: translateX(-10%); }
}

/* Lớp phủ làm chữ nổi */
.site-header::after {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0, 10, 40, 0.45);
}

/* Nội dung nổi lên */
.site-header .container {
    position: relative;
    z-index: 2;
}

/* Tiêu đề */
.site-title h1 {
    letter-spacing: 1.2px;
    font-weight: 900;
    text-shadow: 0 4px 14px rgba(0,0,0,0.7);
}

/* Dòng trên */
.site-title p {
    font-size: 14px;
    letter-spacing: 1px;
    text-shadow: 0 2px 8px rgba(0,0,0,0.6);
}

.uppercase {
    text-transform: uppercase;
}

/* Logo nổi bật */
.site-header img {
    filter: drop-shadow(0 6px 12px rgba(0,0,0,0.5));
}

/* Sóng nhẹ phía dưới */
.site-header::bottom-wave {
    content: "";
}
</style>

<header class="site-header">
    <div class="container">
        <div class="row align-items-center">
            
            {{-- 1. LOGO: Bấm vào để về trang chủ --}}
            <div class="col-auto">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/vodic.gif') }}" alt="Logo" height="85">
                </a>
            </div>
            
            {{-- 2. TIÊU ĐỀ: Bấm vào cũng về trang chủ luôn (Khuyên dùng) --}}
            <div class="col site-title">
                <a href="{{ route('home') }}" class="text-decoration-none">
                    <p class="text-white-50 mb-0 fw-bold uppercase">BỘ TÀI NGUYÊN VÀ MÔI TRƯỜNG</p>
                    <h1 class="text-white m-0 fw-extrabold fs-3 uppercase">CỔNG THÔNG TIN DỮ LIỆU BIỂN & HẢI ĐẢO</h1>
                </a>
            </div>

        </div>
    </div>
</header>

