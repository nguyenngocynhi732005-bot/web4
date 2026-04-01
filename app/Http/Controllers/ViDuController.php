<?php

namespace App\Http\Controllers; 

use Illuminate\Http\Request;
use App\Models\User; 
use App\Notifications\TestSendEmail; 
use Illuminate\Support\Facades\Notification; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ViduController extends Controller
{
function testemail() 
{
    $user = Auth::user();
    
    // Lấy đơn hàng mới nhất của user này
    $latestOrder = DB::table('don_hang')
                     ->where('user_id', $user->id)
                     ->orderBy('id', 'desc')
                     ->first();

    if ($latestOrder) {
        $donHang = DB::select("select * from chi_tiet_don_hang c, sach s 
                               where c.sach_id = s.id 
                               and c.ma_don_hang = ?", [$latestOrder->id]);

        Notification::send($user, new TestSendEmail($donHang));
        return "Đã gửi mail đơn hàng mới nhất (ID: $latestOrder->id)";
    }
    
    return "User này chưa có đơn hàng nào.";
}
}