<?php 

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class Book extends Controller
{
    function sach()
    {
        // STT, tên sách, Nhà xuất bản, tác giả, giá bán, hình ảnh sách
$tpkd=DB::table("sach")->select("id","tieu_de","nha_xuat_ban","gia_ban","link_anh_bia")
                    ->where("the_loai","3")->get();
        return view("thuvien.sach", compact("tpkd"));
    }
}
?>