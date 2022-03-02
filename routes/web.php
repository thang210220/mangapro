<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DanhmucController;
use App\Http\Controllers\TruyenController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TheLoaiController;

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

Route::get('/', [IndexController::class, 'home']);
Route::get('/danh-muc/{slug}', [IndexController::class, 'danhmuc']);
Route::get('/xem-truyen/{slug}', [IndexController::class, 'xemtruyen']);
Route::get('/xem-chapter/{slug}', [IndexController::class, 'xemchapter']);
Route::get('/the-loai/{slug}', [IndexController::class, 'theloai']);
Route::get('/xem-tatca', [IndexController::class, 'xemtatca']);

Route::get('/dang-ky', [IndexController::class, 'dangky']);
Route::get('/dang-nhap', [IndexController::class, 'dangnhap']);

Route::post('/tim-kiem', [IndexController::class, 'timkiem']);
Route::post('/timkiem-ajax', [IndexController::class, 'timkiem_ajax']);

Route::get('/tim-kiem2', [IndexController::class, 'timkiem2']);
Route::post('/timkiem-ajax2', [IndexController::class, 'timkiem_ajax2']);

Route::get('/tim-kiem3', [ChapterController::class, 'timkiem3']);
Route::post('/timkiem-ajax3', [CHapterController::class, 'timkiem_ajax3']);

Route::post('/truyennoibat', [TruyenController::class, 'truyennoibat']);
Route::get('/kytu/{kytu}', [IndexController::class, 'kytu']);
Route::get('/kytu2/{kytu2}', [IndexController::class, 'kytu2']);

Route::post('/uploads-ckeditor','ChapterController@ckeditor_image');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('/danhmuc', DanhmucController::class);
Route::resource('/truyen', TruyenController::class);
Route::resource('/chapter', ChapterController::class);
Route::resource('/theloai', TheLoaiController::class);