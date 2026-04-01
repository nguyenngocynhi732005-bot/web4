<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/sach','App\Http\Controllers\ViduLayoutController@sach');

Route::get("/thongtinsach","App\Http\Controllers\Book@sach");

Route::get('/sach/theloai/{id}','App\Http\Controllers\ViduLayoutController@theloai');
Route::get('/sach/chitiet/{id}','App\Http\Controllers\ViduLayoutController@chitiet');

/*Route::get('/', function () {
return view('welcome');
});*/
Route::get('/','App\Http\Controllers\ViduLayoutController@sach');
Route::get('/accountpanel','App\Http\Controllers\AccountController@accountpanel')
->middleware('auth')->name("account");

Route::post('/saveaccountinfo','App\Http\Controllers\AccountController@saveaccountinfo')
->middleware('auth')->name('saveinfo');

// Đường dẫn đến trang quản lý sách
// Hiển thị danh sách quản lý sách
Route::get('/quanlysach', 'App\Http\Controllers\ViduLayoutController@quanlysach')->name('quanlysach');

// Route Xóa sách (Ví dụ dùng phương thức GET để đơn giản cho bài thực hành)
Route::get('/quanlysach/xoa/{id}', 'App\Http\Controllers\ViduLayoutController@xoasach')->name('xoasach');

Route::get('/order','App\Http\Controllers\BookController@order')->name('order');

Route::post('/cart/add','App\Http\Controllers\BookController@cartadd')->name('cartadd');

Route::post('/cart/delete','App\Http\Controllers\BookController@cartdelete')->name('cartdelete');
Route::post('/order/create','App\Http\Controllers\BookController@ordercreate')
->middleware('auth')->name('ordercreate');

Route::post('/bookview','App\Http\Controllers\BookController@bookview')->name("bookview");

// Route::get('/testemail/{id}','App\Http\Controllers\ViduController@testemail');

Route::get('/testemail', [App\Http\Controllers\ViduController::class, 'testemail']);