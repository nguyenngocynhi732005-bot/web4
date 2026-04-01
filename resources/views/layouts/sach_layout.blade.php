<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .navbar { background-color: #ff5850; font-weight: bold; padding: 0; }
        .nav-item a { color: #fff !important; padding: 10px 15px !important; }
        .nav-item a:hover { background-color: #d44942; }
        .list-book { display: grid; grid-template-columns: repeat(4, 24%); gap: 10px; margin-top: 20px; }
        .book { margin: 10px; text-align: center; transition: transform 0.2s; }
        .book:hover { transform: scale(1.05); }
        .book img { border: 1px solid #ddd; border-radius: 5px; object-fit: cover; }
    </style>
</head>

<body>
    <header style='text-align:center'>
        <img src="{{asset('hinh/banner_sach.jpg')}}" width="1000px">
    </header>

    <main style="width: 1000px; margin: 2px auto;">
        <div class='row'>
            <div class='col-3 pr-0'>
                <nav class="navbar navbar-light align-items-start">
                    <ul class="navbar-nav w-100 px-2">
                        <li class="nav-item"><a class="nav-link" href="{{ url('sach') }}">Trang chủ</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('sach/theloai/1') }}">Tiểu thuyết</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('sach/theloai/2') }}">Truyện ngắn tản văn</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('sach/theloai/3') }}">Tác phẩm kinh điển</a></li>

                        <hr class="border-white w-100 my-2">
                        
                        @auth
                            <li class="nav-item">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-success btn-sm dropdown-toggle w-100 font-weight-bold" data-toggle="dropdown">
                                        Chào, {{ Auth::user()->name }}
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('account') }}">Quản lý cá nhân</a>
                                        <div class="dropdown-divider"></div>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">Đăng xuất</button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @else
                            <li class="nav-item text-center">
                                <a href="{{ route('login') }}" class="btn btn-primary btn-sm btn-block mb-1">Đăng nhập</a>
                                <a href="{{ route('register') }}" class="btn btn-success btn-sm btn-block">Đăng ký</a>
                            </li>
                        @endauth
                    </ul>
                </nav>
                <img src="{{asset('hinh/sidebar_1.jpg')}}" width="100%" class='mt-1 shadow-sm'>
                <img src="{{asset('hinh/sidebar_2.jpg')}}" width="100%" class='mt-1 shadow-sm'>
            </div>

            <div class='col-9 pl-4'>
                @yield('content') 
            </div>
        </div> </main> <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>