<x-book-layout>
    <x-slot name="title">
        Sách
    </x-slot>
    
<div class='list-book'>
    @foreach($data as $row)
    <div class='book'>
        
        <img src="{{$row->link_anh_bia }}" width='200px' height='200px'>
        <br>
        <a href="{{ url('sach/chitiet/' . $row->id) }}">
        <b>{{ $row->tieu_de }}</b>
    </a>
        <br/>
        <i>{{ number_format($row->gia_ban, 0, ",", ".") }}đ</i>
    </div>
    @endforeach
</div>
</x-book-layout>