<x-book-layout>
   
    <div class='list-book'>
        @foreach($data as $row)
        <div class='book'>
            <a href="{{ url('sach/chitiet/' . $row->id) }}">
                <img src="{{ asset($row->link_anh_bia) }}" width="100%" height="200px">
            </a>
            <div class="mt-2">
                <b style="font-size: 14px; display: block; height: 40px; overflow: hidden;">
                    {{ $row->tieu_de }}
                </b>
                <i style="color: #ff5850; font-weight: bold;">
                    {{ number_format($row->gia_ban, 0, ",", ".") }}đ
                </i>
            </div>
        </div>
        @endforeach
    </div>

</x-book-layout>




