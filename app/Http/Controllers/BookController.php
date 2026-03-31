<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class BookController extends Controller{
function laythongtintheloai(){
$the_loai_sach = DB::table("dm_the_loai")->get();
return view("qlsach.the_loai",compact("the_loai_sach"));
}
function laythongtinsach(){
$sach = DB::table("sach")->select("tieu_de","tac_gia")
// ->where("nha_xuat_ban","Văn Học")
->where("gia_ban","<",70000)
->get();


return view("qlsach.thong_tin_sach",compact("sach"));
}

function themtheloai(){
    $data = ["id" =>4, "ten_the_loai"=>"Văn học"];
DB::table("dm_the_loai")->insert($data);
}
}


//Eloquent ORM
use App\Models\Book;
use App\Models\Category;

function laythongtintheloai()
{
$the_loai_sach = Category::all();
return view("qlsach.the_loai",compact("the_loai_sach"));
}
function laythongtinsach()
{
$sach = Book::where("nha_xuat_ban","Văn Học")
 
->where("gia_ban","<",70000)
->orderBy("gia_ban","desc")->get();
return view("qlsach.thong_tin_sach",compact("sach"));
}
function suatheloai(){
    $data = ["ten_the_loai" => "Văn học"]; // Dữ liệu mới 
    DB::table("dm_the_loai")
        ->where("id", 4) // Phải có dòng này để xác định sửa hàng nào [cite: 359, 360]
        ->update($data); 
return 'suathanhcong';

}
function xoatheloai(){
    Category::where("id",4)->delete();
return 'xoathanhcong';

}
// $category = new Category;
// $category->id = 4;
// $category->ten_the_loai = "Trinh thám";
// $category->save();



?>