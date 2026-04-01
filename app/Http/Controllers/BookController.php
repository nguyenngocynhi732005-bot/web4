<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 

class BookController extends Controller
{
   public function index() {
    $data = DB::table('sach')->get(); 
    return view('vidusach.book_list', compact('data')); 
}

    public function create() {
    return view('vidusach.book_create'); // Em sẽ tạo file này sau
}

public function edit($id) {
    $book = DB::table('sach')->where('id', $id)->first();
    return view('vidusach.book_edit', compact('book'));
}

public function bookdelete(Request $request) {
    $id = $request->id;
    DB::table('sach')->where('id', $id)->delete();
    
    return redirect()->back()->with('status', 'Đã xóa sách thành công!');
}
   
}