<x-book-layout>
    <x-slot name="title">
        Chi tiết: {{ $sach->tieu_de }}
    </x-slot>
    <div class="container-fluid bg-white p-3 shadow-sm rounded">
    <h3 class="mb-3 text-dark" style="font-weight: 500;">{{ $sach->tieu_de }}</h3>

    <div class="row">
        <div class="col-md-5">
            
                <img src="{{ asset($sach->link_anh_bia) }}" width="100%" height="200px">
            
        </div>
        <div class="col-md-7">
            <div class="info-detail" style="font-size: 16px; line-height: 2;">
                <div>Nhà cung cấp: <strong class="text-primary">{{ $sach->nha_cung_cap}}</strong></div>
                <div>Nhà xuất bản: <strong class="text-primary">{{ $sach->nha_xuat_ban}}</strong></div>
                <div>Tác giả: <strong class="text-primary">{{ $sach->tac_gia}}</strong></div>
                <div>Hình thức bìa: <strong class="text-primary">{{ $sach->hinh_thuc_bia}}</strong></div>
                <p>Giá bán: <span class="text-danger"><b>{{ number_format($sach->gia_ban, 0, ",", ".") }}đ</b></span></p>

                <div class='mt-1'>
                Số lượng mua:
                <input type='number' id='product-number' size='5' min="1" value="1">
                <button class='btn btn-success btn-sm mb-1' id='add-to-cart'>Thêm vào giỏ hàng</button>
                </div>
            </div>
        </div>
    </div>


    <div class="row mt-4">
        <div class="col-12">
            <h5 class="font-weight-bold" style="border-bottom: 2px solid #eee; padding-bottom: 10px;">Mô tả:</h5>
            <div class="description-text mt-2" style="text-align: justify; line-height: 1.6; color: #333;">
                {{ $sach->mo_ta }}
                </div>
        </div>

   
<script>
        $(document).ready(function(){
        $("#add-to-cart").click(function(){
    id = "{{$sach->id}}";
        num = $("#product-number").val()
        $.ajax({
        type:"POST",
        dataType:"json",
        url: "{{route('cartadd')}}",
        data:{"_token": "{{ csrf_token() }}","id":id,"num":num},
        beforeSend:function(){
        },
        success:function(data){
        $("#cart-number-product").html(data);
        },
        error: function (xhr,status,error){
        },
        complete: function(xhr,status){
        }
        });
        });
        });
</script>   
                

    </div>
</div>

<style>
    .info-detail strong {
        color: #000;
        margin-left: 5px;
    }
    .description-text {
        font-size: 15px;
        white-space: pre-line; /* Giữ lại các khoảng xuống dòng từ database */
    }
</style>
</x-book-layout>