<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ViDuLayoutController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\BookController;

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


Route::get('/trang1','App\Http\Controllers\ViduLayoutController@trang1');
Route::get('/sach','App\Http\Controllers\ViduLayoutController@sach');
Route::get('/sach/theloai/{id}','App\Http\Controllers\ViduLayoutController@theloai');
Route::get('/sach/chitiet/{id}', [App\Http\Controllers\ViDuLayoutController::class, 'chitiet'])->name('sach.chitiet');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
Route::get('/', 'App\Http\Controllers\ViduLayoutController@sach');
Route::get('/accountpanel', [AccountController::class, 'accountpanel'])
    ->middleware('auth')->name("account");
Route::post('/saveaccountinfo', [AccountController::class, 'saveaccountinfo'])
    ->middleware('auth')->name('saveinfo');
// Hiển thị danh sách sách
Route::get('/quanlysach', [App\Http\Controllers\BookController::class, 'index'])->name('books.list');

// Hiển thị form thêm mới
Route::get('/quanlysach/create', [App\Http\Controllers\BookController::class, 'create'])->name('bookcreate');

Route::get('/quanlysach/edit/{id}', [App\Http\Controllers\BookController::class, 'edit'])->name('bookedit');

// Xử lý xóa sách
Route::post('/quanlysach/delete', [App\Http\Controllers\BookController::class, 'bookdelete'])->name('bookdelete');