<?php 


namespace App\Http\Controllers; // Khai báo vị trí của file này

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Dòng này để sửa lỗi "Undefined type DB"

use App\Http\Controllers\Controller; // "Nhập" lớp Controller gốc vào để sử dụng

class ViduLayoutController extends Controller
{
function trang1()
{
return view("vidulayout.trang1");
}

function sach()
{
$data = DB::select("select * from sach order by gia_ban asc limit 0,8");
return view("vidusach.index", compact("data"));
}
function theloai($id)
{
$data = DB::select("select * from sach where the_loai = ?",[$id]);
return view("vidusach.index", compact("data"));
}
// Thêm vào trong class ViduLayoutController
function chitiet($id)
{
    // Lấy một dòng dữ liệu duy nhất từ bảng sach theo id
    $book = DB::select("select * from sach where id = ?", [$id]);
    
    // Nếu tìm thấy sách, trả về view chi tiết và truyền biến $book[0] sang
    if (!empty($book)) {
        return view("vidusach.chitiet", ['sach' => $book[0]]);
    }
    return redirect('/sach'); // Nếu không thấy thì quay về trang chủ
}
}
?>

