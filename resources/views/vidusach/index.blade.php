<x-book-layout>
    <x-slot name="title">
        Nhà Sách Phương Nam
    </x-slot>

    <h5 class="mt-3 text-uppercase font-weight-bold" style="color: #555;">Sách mới nhất</h5>
    <hr>

    <div id='book-view-div'>
        <div class='list-book'>
            @foreach($data as $row)
            <div class='book'>
                <a href="{{ url('sach/chitiet/' . $row->id) }}">
                    <img src="{{ asset($row->link_anh_bia) }}" width="100%" height="200px" style="object-fit: contain;">
                </a>
                <div class="mt-2">
                    <b class="book-title">
                        {{ $row->tieu_de }}
                    </b>
                    <i class="book-price">
                        {{ number_format($row->gia_ban, 0, ",", ".") }}đ
                    </i>
                </div>

                <div class='btn-add-product'>
                    <button class='btn btn-success btn-sm mb-1 add-product' book_id="{{$row->id}}">
                        <i class="fa fa-cart-plus"></i> Thêm vào giỏ hàng
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // 1. Xử lý lọc theo thể loại (Ajax)
            $(".menu-the-loai").click(function(e) {
                e.preventDefault();
                var the_loai = $(this).attr("the_loai");

                $.ajax({
                    type: "POST",
                    dataType: "html",
                    url: "{{ route('bookview') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "the_loai": the_loai
                    },
                    success: function(data) {
                        $("#book-view-div").html(data);
                    },
                    error: function(xhr, status, error) {
                        console.error("Lỗi lọc thể loại: " + error);
                    }
                });
            });

            // 2. Xử lý thêm vào giỏ hàng (Dùng Event Delegation để Ajax vẫn chạy được)
            $(document).on("click", ".add-product", function() {
                var id = $(this).attr("book_id");
                var num = 1;

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('cartadd') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id,
                        "num": num
                    },
                    success: function(data) {
                        // Cập nhật badge giỏ hàng trên giao diện chính
                        $("#cart-number-product").html(data);
                        alert("Đã thêm vào giỏ hàng thành công!");
                    },
                    error: function(xhr, status, error) {
                        console.error("Lỗi thêm giỏ hàng: " + error);
                    }
                });
            });
        });
    </script>

    <style>
        .list-book {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
        }

        .book {
            position: relative;
            margin: 10px;
            text-align: center;
            padding: 10px;
            padding-bottom: 55px;
            /* Tăng khoảng cách để không đè lên nút */
            border: 1px solid #eee;
            border-radius: 5px;
            background: #fff;
            transition: 0.3s;
            display: flex;
            flex-direction: column;
        }

        .book:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .book-title {
            font-size: 14px;
            display: block;
            height: 40px;
            overflow: hidden;
            margin-bottom: 5px;
        }

        .book-price {
            color: #ff5850;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .btn-add-product {
            position: absolute;
            bottom: 10px;
            width: 100%;
            left: 0;
            padding: 0 10px;
        }
    </style>
</x-book-layout>