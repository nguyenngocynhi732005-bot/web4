<!DOCTYPE html>
<html>
<<<<<<< HEAD
    <head>
        <title>{{ $title ?? 'Nhà sách' }}</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            /* Định dạng màu nền và màu chữ của menu */
            .navbar {
                background-color: #ff5850;
                max-width:1000px;
                font-weight:bold;
                margin:0 auto;

            }
            .nav-item a
            {
                color: #fff!important;
            }

            .list-book
            {
                display:grid;
                grid-template-columns:repeat(5,20%);
            }
            .book
            {
            
                margin:10px;
                text-align:center;
            }
        </style>
    </head>
    <body>
        <header style='text-align:center'>
            <img src="{{asset('hinh/banner_sach.jpg')}}" width="1000px">
            <nav class="navbar navbar-light navbar-expand-sm">
                <div class='container-fluid p-0'>
                    <div class='col-9 p-0'>
                            <ul class="navbar-nav">
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{url('sach')}}">Trang chủ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('sach/theloai/1')}}">Tiểu thuyết</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('sach/theloai/2')}}">Truyện ngắn - tản văn</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('sach/theloai/3')}}">Tác phẩm kinh điển</a>
                                </li>
                            </ul>
                    </div>
                    <div class='col-3 p-0 d-flex justify-content-end'>
                        <div style='color:white;position:relative' class='mr-2'>
                        <div style='width:20px; height:20px;background-color:#23b85c; font-size:12px; border:none;
                        border-radius:50%; position:absolute;right:2px;top:-2px' id='cart-number-product'>
                        @if (session('cart'))
                        {{ count(session('cart')) }}
                        @else
                        0
                        @endif
                        </div>
                    </div>
                        @auth
                            <div class="dropdown">
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                {{ Auth::user()->name }}
                                </button>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('account')}}">Quản lý</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" onclick="event.preventDefault();
                                                        this.closest('form').submit();">Đăng xuất</a>
                                </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}">
                                <button class='btn btn-sm btn-primary'>Đăng nhập</button>
                            </a>&nbsp;
                            <a href="{{ route('register') }}">
                                <button class='btn btn-sm btn-success'>Đăng ký</button>
                            </a>
                        @endauth
                </div>
            </nav>
        </header>
        <main style="width:1000px; margin:2px auto;">
            <div class='row'>
                <div class='col-12'>
                   {{$slot}}
                </div>
            </div>
        </main>
        <!--<footer>
            <div class='row' style='text-align:center'>
                <div class='col-4'>TRỤ SỞ</div>
                <div class='col-4'>THÔNG TIN CHUNG</div>
                <div class='col-4'>BẢN ĐỒ</div>
            </div>
        </footer>-->
    </body>
=======
<head>
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .navbar {
            background-color: #ff5850;
            max-width: 1000px;
            font-weight: bold;
            margin: 0 auto;
        }
        .nav-item a { color: #fff !important; }
        .list-book {
            display: grid;
            grid-template-columns: repeat(5, 20%);
        }
        .book {
            margin: 10px;
            text-align: center;
            position:relative;
            padding-bottom:35px;
        }
        /* Style cho vòng tròn số lượng giỏ hàng  */
        #cart-number-product {
            width: 20px;
            height: 20px;
            background-color: #23b85c;
            font-size: 12px;
            border-radius: 50%;
            position: absolute;
            right: -5px; /* Đẩy sát biểu tượng giỏ hàng */
            top: -2px;
            line-height: 20px;
            text-align: center;
            color: white;
        }
        .btn-add-product
        {
        position:absolute;
        bottom:0;
        width:100%;
        }
    </style>
</head>
<body>
    <header style='text-align:center'>
        <img src="{{ asset('anh/banner_sach.jpg') }}" width="1000px">
        
        <nav class="navbar navbar-light navbar-expand-sm">
            <div class='container-fluid p-0 d-flex align-items-center'>
                
                <div class='flex-grow-1'>
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link menu-the-loai" href="{{ url('sach') }}">Trang chủ</a></li>
                        <li class="nav-item">
                            <a class="nav-link menu-the-loai" href="{{ url('sach/theloai/1') }}">Tiểu thuyết</a></li>
                        <li class="nav-item">
                            <a class="nav-link menu-the-loai" href="{{ url('sach/theloai/2') }}">Truyện ngắn - tản văn</a></li>
                        <li class="nav-item">
                            <a class="nav-link menu-the-loai" href="{{ url('sach/theloai/3') }}">Tác phẩm kinh điển</a></li>
                    </ul>
                </div>

                <div class='d-flex align-items-center pr-2'>
                    
                    <div style='position: relative' class='mr-4'>
                        <a href="{{ route('order') }}" style='cursor:pointer; color: white;'>
                            <i class="fa fa-cart-arrow-down fa-2x mt-2"></i>
                            <div id='cart-number-product'>
                                {{ session('cart') ? count(session('cart')) : 0 }} 
                            </div>
                        </a>
                    </div>

                    @auth
                        <div class="dropdown">
                            <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                {{ Auth::user()->name }} 
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('account') }}">Quản lý</a> 
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" style="cursor:pointer" onclick="event.preventDefault(); this.closest('form').submit();">
                                        Đăng xuất
                                    </a> 
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="d-flex">
                            <a href="{{ route('login') }}" class='btn btn-sm btn-primary mr-1'>Đăng nhập</a> 
                            <a href="{{ route('register') }}" class='btn btn-sm btn-success'>Đăng ký</a> 
                        </div>
                    @endauth
                </div>

            </div>
        </nav>
    </header>

    <main style="width:1000px; margin:2px auto;">
        <div class='row'>
            <div class='col-12'>
                {{ $slot }}
            </div>
        </div>
    </main>
</body>
>>>>>>> remotes/origin/QuynhAnh
</html>