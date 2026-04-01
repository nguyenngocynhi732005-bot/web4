<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Notifications\TestSendEmail;
use Illuminate\Support\Facades\Notification;

class BookController extends Controller
{
    function laythongtintheloai()
    {
        $the_loai_sach = DB::table("dm_the_loai")->get();
        return view("qlsach.the_loai", compact("the_loai_sach"));
    }

    function laythongtinsach()
    {
        $sach = DB::table("sach")->select("tieu_de", "tac_gia")
            ->where("gia_ban", "<", 70000)
            ->get();

        return view("qlsach.thong_tin_sach", compact("sach"));
    }

    function themtheloai()
    {
        $data = ["id" => 4, "ten_the_loai" => "Văn học"];
        DB::table("dm_the_loai")->insert($data);
    }

    public function cartadd(Request $request)
    {
        $request->validate([
            "id" => ["required", "numeric"],
            "num" => ["required", "numeric"]
        ]);

        $id = $request->id;
        $num = $request->num;
        $cart = session()->get("cart", []);

        if (isset($cart[$id])) {
            $cart[$id] += $num;
        } else {
            $cart[$id] = $num;
        }

        session()->put("cart", $cart);
        return count($cart);
    }

    public function order()
    {
        $cart = session("cart", []);
        $data = [];
        $quantity = [];

        if (!empty($cart)) {
            $quantity = $cart;
            $list_book = implode(',', array_keys($cart));
            $data = DB::table("sach")->whereRaw("id in ($list_book)")->get();
        }

        return view("vidusach.order", compact("quantity", "data"));
    }

    public function cartdelete(Request $request)
    {
        $request->validate(["id" => ["required", "numeric"]]);
        $id = $request->id;
        
        $cart = session()->get("cart", []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }
        
        session()->put("cart", $cart);
        return redirect()->route('order');
    }

    public function ordercreate(Request $request)
    {
        $request->validate([
            "hinh_thuc_thanh_toan" => ["required", "numeric"]
        ]);

        // Biến để chứa thông báo thành công
        $thong_bao = null;

        if (session()->has('cart')) {
            $cart = session("cart");
            $user = Auth::user();

            $order = [
                "ngay_dat_hang" => DB::raw("now()"),
                "tinh_trang" => 1,
                "hinh_thuc_thanh_toan" => $request->hinh_thuc_thanh_toan,
                "user_id" => $user->id
            ];

            DB::transaction(function () use ($order, $cart, $user) {
                // 1. Lưu đơn hàng
                $id_don_hang = DB::table("don_hang")->insertGetId($order);

                // 2. Lấy thông tin sách trong giỏ
                $list_book = implode(',', array_keys($cart));
                $books = DB::table("sach")->whereRaw("id in ($list_book)")->get();

                // 3. Chuẩn bị và lưu chi tiết đơn hàng
                $detail = [];
                foreach ($books as $row) {
                    $detail[] = [
                        "ma_don_hang" => $id_don_hang,
                        "sach_id" => $row->id,
                        "so_luong" => $cart[$row->id],
                        "don_gia" => $row->gia_ban
                    ];
                }
                DB::table("chi_tiet_don_hang")->insert($detail);

                // 4. Truy vấn lại dữ liệu đầy đủ (join bảng) để gửi Email
                $donHangDayDu = DB::table('chi_tiet_don_hang')
                    ->join('sach', 'chi_tiet_don_hang.sach_id', '=', 'sach.id')
                    ->where('chi_tiet_don_hang.ma_don_hang', $id_don_hang)
                    ->get();

                // 5. Gửi Notification Email
                Notification::send($user, new TestSendEmail($donHangDayDu));

                // 6. Xóa giỏ hàng sau khi đã xử lý xong hết
                session()->forget('cart');
            });

            $thong_bao = "Đặt hàng thành công! Cảm ơn bạn đã mua sắm.";
        }

        // Trả về view với data rỗng và thông báo thành công
        return view("vidusach.order", [
            'data' => [], 
            'quantity' => [], 
            'thong_bao' => $thong_bao
        ]);
    }

    public function bookview(Request $request)
    {
        $the_loai = $request->input("the_loai");
        if ($the_loai != "") {
            $data = DB::select("select * from sach where the_loai = ?", [$the_loai]);
        } else {
            $data = DB::select("select * from sach order by gia_ban asc limit 0,10");
        }
        return view("vidusach.bookview", compact("data"));
    }
}