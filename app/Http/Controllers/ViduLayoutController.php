<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class ViduLayoutController extends Controller
{
    function trang1()
    {
        return view("vidulayout.trang1");
    }

    function sach()
    {
        // Truy vấn 8 cuốn sách có giá bán thấp nhất
        $data = DB::select("select * from sach order by gia_ban asc limit 0,8");
        // Trả về view index và truyền biến data sang
        return view("vidusach.index", compact("data"));
    }

    // Hàm hiển thị sách theo thể loại
    function theloai($id)
    {
        // Truy vấn sách dựa trên ID thể loại được truyền từ URL
        $data = DB::select("select * from sach where the_loai = ?", [$id]);
        return view("vidusach.index", compact("data"));
    }
    public function chiTiet($id)
{
    // Lấy thông tin cuốn sách theo ID
    $data = DB::select("select * from sach where id = ?", [$id]);

    if(count($data) > 0) {
        $sach = $data[0];
        return view('vidusach.chitiet', compact('sach'));
    } else {
        return redirect()->route('vidusach.index')->with('error', 'Không tìm thấy sách');
    }
}
    
}
