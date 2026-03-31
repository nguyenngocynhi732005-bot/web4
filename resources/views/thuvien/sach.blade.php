<html>
    <head>
<style>
    table{
        border-collapse: collapse;
        margin: auto;
        padding: 50px;
    }
    td{
        text-align: center;
        padding: 30px;
    }
    th{
        padding: 20px;
    }
</style>
    </head>
    <body>
    <table border="1">
        <tr>
<th> STT </th>
<th>Tên sách </th>
<th>Nhà xuất bản</th>
<th>Giá bán</th>
<th>Hình ảnh sách</th>

        </tr>

        @foreach($tpkd as $row)
        <tr>
       <td>  {{$row->id}}</td>
        <td> {{$row->tieu_de}} </td>
       <td>  {{$row->nha_xuat_ban}}</td>
        <td> {{$row->gia_ban}}</td>
        <td><img src="{{$row->link_anh_bia}}" alt="{{ $row->tieu_de }}" width="100"></td>
        </tr>

        @endforeach
        </table>
    </body>
</html>