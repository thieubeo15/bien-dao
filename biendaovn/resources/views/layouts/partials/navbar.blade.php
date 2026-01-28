<nav class="navbar navbar-expand-lg navbar-main sticky-top border-top border-white border-opacity-10">
    <div class="container">
        <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold" href="{{ route('home') }}"><i class="fas fa-home"></i> TRANG CHỦ</a>
                </li>
                @if(isset($categories))
                    @foreach($categories as $cat)
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('category.show', $cat->id) }}">{{ $cat->name }}</a>
                        </li>
                    @endforeach
                @endif
            </ul>
            <div class="ms-auto">
                @auth
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm rounded-pill px-3 dropdown-toggle fw-bold" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-check mr-1"></i> {{ Auth::user()->name }}
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
                    <a href="{{ route('login') }}" class="btn btn-light btn-sm rounded-pill px-3 fw-bold text-primary">ĐĂNG NHẬP</a>
                @endauth
            </div>
        </div>
    </div>
</nav>