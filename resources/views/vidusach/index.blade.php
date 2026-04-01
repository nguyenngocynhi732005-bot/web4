<x-book-layout>
    <x-slot name="title">
        Nhà Sách Phương Nam
    </x-slot>

    <h5 class="mt-3 text-uppercase font-weight-bold" style="color: #555;">Sách mới nhất</h5>
    <hr>

    <!-- Thẻ div này sẽ là nơi chứa và thay đổi danh sách sách khi bạn chọn thể loại -->
    <div id='book-view-div'>
        <div class='list-book'>
            @foreach($data as $row)
            <div class='book'>
                <a href="{{ url('sach/chitiet/' . $row->id) }}">
                    <!-- Sử dụng link_anh_bia để đồng nhất với các trang trước bạn đã làm -->
                    <img src="{{ asset($row->link_anh_bia) }}" width="100%" height="200px" style="object-fit: contain;">
                </a>
                <div class="mt-2">
                    <b style="font-size: 14px; display: block; height: 40px; overflow: hidden;">
                        {{ $row->tieu_de }}
                    </b>
                    <i style="color: #ff5850; font-weight: bold; display: block; margin-bottom: 5px;">
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

            // 1. Xử lý lọc theo thể loại (Ajax trả về HTML)
            $(".menu-the-loai").click(function(e) {
                e.preventDefault(); // Ngăn trang bị cuộn lên đầu do href="#"

                var the_loai = $(this).attr("the_loai");

                $.ajax({
                    type: "POST",
                    dataType: "html", // Dữ liệu trả về là đoạn mã HTML từ view con
                    url: "{{ route('bookview') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "the_loai": the_loai
                    },
                    success: function(data) {
                        // Thay thế toàn bộ nội dung trong div bằng danh sách mới
                        $("#book-view-div").html(data);
                    },
                    error: function(xhr, status, error) {
                        console.error("Lỗi lọc thể loại: " + error);
                    }
                });
            });

            // 2. Xử lý thêm vào giỏ hàng (Dùng Event Delegation)
            // Thay vì $(".add-product").click, ta dùng $(document).on để các nút mới load về vẫn chạy được
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
                        // Cập nhật số lượng trên icon giỏ hàng ở Layout
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
            padding-bottom: 45px;
            /* Khoảng trống cho nút bấm tuyệt đối */
            border: 1px solid #eee;
            border-radius: 5px;
            background: #fff;
            transition: 0.3s;
        }

        .book:hover {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-add-product {
            position: absolute;
            bottom: 10px;
            width: 100%;
            left: 0;
        }
    </style>
</x-book-layout>