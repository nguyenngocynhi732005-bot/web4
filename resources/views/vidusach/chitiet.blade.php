<x-book-layout>
    
    <x-slot name="title">
        Chi tiết: {{ $sach->tieu_de }}
    </x-slot>

<div class="row">
    
    <div class="col-12">
<h4><p style="text-align: center">{{ $sach->tieu_de }}</p></h4>
    </div>
    <div class="col-4" style="padding: 0 20px;">
        <img src="{{ $sach->link_anh_bia }}" width="100%" alt="{{ $sach->tieu_de }}">
    </div>

    <div class="col-7">
        <p>Nhà cung cấp: <b>Hải Đăng</b></p>
        <p>Nhà xuất bản: <b>NXB Văn Học</b></p>
        <p>Tác giả: <b>{{ $sach->tac_gia ?? 'Đang cập nhật' }}</b></p>
        <p>Hình thức bìa: <b>{{ $sach->hinh_thuc_bia ?? 'Đang cập nhật' }}</b></p>
        <p>Giá bán: <span class="text-danger"><b>{{ number_format($sach->gia_ban, 0, ",", ".") }}đ</b></span></p>
        <div class='mt-1'>
        Số lượng mua:
        <input type='number' id='product-number' size='5' min="1" value="1">
        <button class='btn btn-success btn-sm mb-1' id='add-to-cart'>Thêm vào giỏ hàng</button>
        </div>

<script>
        $(document).ready(function(){
        $("#add-to-cart").click(function(){
        id = "{{$data->id}}";
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
<h5 style="padding: 0 20px;">Mô tả: </h5>
    <p 
     style="text-align: justify; font-family: Arial, sans-serif; padding: 0 20px;">{{ $sach->mo_ta }}</p>

</x-book-layout>