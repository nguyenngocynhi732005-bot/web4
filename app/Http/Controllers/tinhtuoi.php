<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tinhtuoi extends Controller
{
public function tuoi(){
    return view('tuoi');
}
    
function tinhtuoi(Request $request)
{
$nam_sinh = $request->input("nam_sinh");
$nam = date('Y');
$ket_qua = $nam - $nam_sinh;
return "Số tuổi năm nay là: ".$ket_qua;
}


}
