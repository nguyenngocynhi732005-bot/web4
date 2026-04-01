<!DOCTYPE html>
<html>

<head>
    <title>{{ $title ?? 'Nha sach' }}</title>
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

        .nav-item a {
            color: #fff !important;
        }

        .list-book {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
        }

        .book {
            text-align: center;
            display: flex;
            flex-direction: column;
        }

        .book-img-container {
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            overflow: hidden;
        }

        .book-img-container img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar-img {
            width: 100%;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        /* Style cho Badge số lượng giỏ hàng theo tài liệu */
        #cart-number-product {
            position: relative;
            padding-bottom: 35px;
            width: 20px;
            height: 20px;
            background-color: #3b85c3;
            color: white;
            border-radius: 50%;
            position: absolute;
            right: -5px;
            top: -5px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .main-content {
            max-width: 1000px;
            /* Bằng với chiều rộng của banner và navbar */
            margin: 0 auto;
            /* auto ở hai bên sẽ giúp căn giữa */
            padding: 20px 0;
            /* Khoảng cách đệm để không dính sát mép màn hình trên mobile */
        }

        /* Cập nhật lại list-book để hiển thị đẹp hơn */
        .list-book {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            justify-items: center;
            /* Căn giữa các item bên trong grid */
        }

        #cart-number-product {
            top: -2px;
            line-height: 20px;
            text-align: center;
            color: white;
        }

        .btn-add-product {
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <header style="text-align:center">
        <img src="{{ asset('anh/banner_sach.jpg') }}" width="1000px">

        <nav class="navbar navbar-light navbar-expand-sm">
            <div class="container-fluid p-0 d-flex align-items-center">
                <div class="flex-grow-1">
                    <ul class="navbar-nav">
                        <li class="nav-item active"><a class="nav-link menu-the-loai" href="{{ url('sach') }}">Trang chủ</a></li>
                        <li class="nav-item"><a class="nav-link menu-the-loai" href="{{ url('sach/theloai/1') }}">Tiểu thuyết</a></li>
                        <li class="nav-item"><a class="nav-link menu-the-loai" href="{{ url('sach/theloai/2') }}">Truyện ngắn - Tản văn</a></li>
                        <li class="nav-item"><a class="nav-link menu-the-loai" href="{{ url('sach/theloai/3') }}">Tác phẩm kinh điển</a></li>
                    </ul>
                </div>

                <div class="d-flex align-items-center pr-2">
                    <div style="position: relative" class="mr-4">
                        <a href="{{ route('order') }}" style="cursor:pointer; color: white;">
                            <i class="fa fa-cart-arrow-down fa-2x mt-2"></i>
                            <div id="cart-number-product">
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
                        <a href="{{ route('login') }}" class="btn btn-sm btn-primary mr-1">Đăng nhập</a>
                        <a href="{{ route('register') }}" class="btn btn-sm btn-success">Đăng ký</a>
                    </div>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <main style="width:1000px; margin:2px auto;">
        <div class="row">
            <div class="col-12">
                {{ $slot }}
            </div>
        </div>
    </main>
</body>

</html>