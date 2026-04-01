<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViduLayoutController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ViduController;

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

Route::get('/', [ViduLayoutController::class, 'sach']);
Route::get('/trang1', [ViduLayoutController::class, 'trang1']);
Route::get('/sach', [ViduLayoutController::class, 'sach']);
Route::get('/sach/theloai/{id}', [ViduLayoutController::class, 'theloai']);
Route::get('/sach/chitiet/{id}', 'App\\Http\\Controllers\\ViduLayoutController@chiTiet')->name('sach.chitiet');
Route::get('/quanlysach/xoa/{id}', [ViduLayoutController::class, 'xoasach'])->name('xoasach');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::get('/accountpanel', 'App\Http\Controllers\AccountController@accountpanel')
    ->middleware('auth')->name('account');
Route::post('/saveaccountinfo', 'App\Http\Controllers\AccountController@saveaccountinfo')
    ->middleware('auth')->name('saveinfo');

// Hiển thị danh sách sách
Route::get('/quanlysach', [BookController::class, 'index'])->name('books.list');

// Hiển thị form thêm mới
Route::get('/quanlysach/create', [BookController::class, 'create'])->name('bookcreate');

Route::get('/quanlysach/edit/{id}', [BookController::class, 'edit'])->name('bookedit');

// Xử lý xóa sách
Route::post('/quanlysach/delete', [BookController::class, 'bookdelete'])->name('bookdelete');

Route::get('/order', [BookController::class, 'order'])->name('order');
Route::post('/cart/add', [BookController::class, 'cartadd'])->name('cartadd');
Route::post('/cart/delete', [BookController::class, 'cartdelete'])->name('cartdelete');
Route::post('/order/create', [BookController::class, 'ordercreate'])
    ->middleware('auth')->name('ordercreate');
Route::post('/bookview', [BookController::class, 'bookview'])->name('bookview');

Route::get('/testemail', [ViduController::class, 'testemail']);
