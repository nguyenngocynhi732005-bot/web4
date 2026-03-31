<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViDuController extends Controller
{
public function vidu1(){
    return view('vidu1');
}
    
function tinhtong(Request $request)
{
$so_a = $request->input("so_a");
$so_b = $request->input("so_b");
$ket_qua = $so_a+$so_b;
return "Kết quả là: ".$ket_qua;
}

function thuhientai(){
    $thu = date('l');
    return "Today is $thu";
}

function hubview(){
    $data ="DHNH";
    $data2 ="DHNH";
    return view('vidu1',compact("data"));
}
}
