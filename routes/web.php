<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IndoregionController;
use App\Http\Controllers\IklanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\GambarController;

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

//---------------------------Menu Dashboard Guest---------------------------- 
Route::get('/', [GuestController::class, 'welcome']);
Route::get('/tentang', [GuestController::class, 'tentang']);
Route::get('/mengapa', [GuestController::class, 'mengapa']);
Route::get('/syarat', [GuestController::class, 'syarat']);
Route::get('/iklan', [GuestController::class, 'iklan']);
Route::get('/kerjasama', [GuestController::class, 'kerjasama']);

//---------------------------Menu Dashboard User---------------------------- 
Route::get('/profil', [UserController::class, 'profil'])->middleware('user');
Route::get('/usertentang', [UserController::class, 'tentang'])->middleware('user');
Route::get('/usermengapa', [UserController::class, 'mengapa'])->middleware('user');
Route::get('/usersyarat', [UserController::class, 'syarat'])->middleware('user');
Route::get('/userblog', [UserController::class, 'iklan'])->middleware('user');
Route::get('/userkerjasama', [UserController::class, 'kerjasama'])->middleware('user');

// --------------------------Menu Iklan-----------------------------------
Route::get('/jenisiklan/{id}', [IklanController::class, 'jenis_iklan'])->name('guest.jenisiklan');
Route::get('/iklan/{id}', [IklanController::class, 'iklan_detail'])->name('guest.iklan.detail');
Route::get('/iklan', [IklanController::class, 'iklan'])->name('guest.iklan');

// --------------------------Menu Register-----------------------------------
Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('register', [UserController::class, 'register_action'])->name('register.action');

// --------------------------Menu Login--------------------------------------
Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'login_action'])->name('login.action');

// --------------------------Menu Logout--------------------------------------
Route::get('logout', [UserController::class, 'logout'])->name('logout');

// --------------------------Menu Ganti Password--------------------------------------
Route::get('password', [UserController::class, 'password'])->name('password')->middleware('user');
Route::post('password', [UserController::class, 'password_action'])->name('password.action')->middleware('user');

// --------------------------Menu Reset Password--------------------------------------
Route::get('forget', [UserController::class, 'forget'])->name('forget');
Route::post('forget', [UserController::class, 'forget_action'])->name('forget.action');

// --------------------------Menu Update Profil--------------------------------------
Route::post('profil', [UserController::class, 'profil_action'])->name('profil.action')->middleware('user');

// --------------------------Alamat--------------------------------------
Route::post('kabupaten', [IndoregionController::class, 'getRegency'])->name('getRegency');
Route::post('kecamatan', [IndoregionController::class, 'getDistrict'])->name('getDistrict');
Route::post('desa', [IndoregionController::class, 'getVillage'])->name('getVillage');

// --------------------------Iklan--------------------------------------
Route::get('/tambahiklan', [IndoregionController::class, 'alamat'])->middleware('user');
Route::get('/iklansaya', [UserController::class, 'iklansaya'])->middleware('user');
Route::get('/iklansaya/{id}', [UserController::class, 'iklansaya_detail'])->middleware('user');

Route::get('/pembayaran', [UserController::class, 'pembayaran'])->middleware('user');
Route::get('/pembayaran/{id}', [UserController::class, 'pembayaran_detail'])->middleware('user');
Route::get('/bayar/{id}', [UserController::class, 'bayar']);
Route::get('/bayar/iklan/{id}', [IklanController::class, 'bayar_iklan']);

Route::post('/store-iklan', [IklanController::class, 'store'])->name('store.iklan');
Route::get('/iklansaya/edit/{id}', [IklanController::class, 'iklan_edit'])->name('siklan.edit')->middleware('user');
Route::post('/iklansaya/edit_action', [IklanController::class, 'iklan_edit_action'])->name('iklan.edit_action')->middleware('user');
Route::get('/iklansaya/hapus/{id}', [IklanController::class, 'iklan_hapus'])->name('iklan.hapus')->middleware('user');
// --------------------------Admin--------------------------------------
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware('admin');
Route::get('/admin/jenisiklan', [AdminController::class, 'jenisIklan'])->name('admin.jenisiklan')->middleware('admin');
Route::get('/admin/jenisiklan/tambah', [AdminController::class, 'jenisIklan_tambah'])->name('admin.jenisiklan.tambah')->middleware('admin');
Route::post('/admin/jenisiklan/tambah_action', [AdminController::class, 'jenisIklan_tambah_action'])->name('admin.jenisiklan.tambah_action')->middleware('admin');
Route::get('/admin/jenisiklan/edit/{id}', [AdminController::class, 'jenisIklan_edit'])->name('admin.jenisiklan.edit')->middleware('admin');
Route::post('/admin/jenisiklan/edit_action', [AdminController::class, 'jenisIklan_edit_action'])->name('admin.jenisiklan.edit_action')->middleware('admin');
Route::get('/admin/jenisiklan/hapus/{id}', [AdminController::class, 'jenisIklan_hapus'])->name('admin.jenisiklan.hapus')->middleware('admin');

Route::get('/admin/iklan', [AdminController::class, 'iklan'])->name('admin.iklan')->middleware('admin');
Route::get('/admin/iklan/{id}', [AdminController::class, 'iklan_detail'])->name('admin.iklan_detail')->middleware('admin');
Route::get('/admin/iklan/edit/{id}', [AdminController::class, 'iklan_edit'])->name('siklan.edit')->middleware('admin');
Route::post('/admin/iklan/edit_action', [AdminController::class, 'iklan_edit_action'])->name('iklan.edit_action')->middleware('admin');
Route::get('/admin/iklan/hapus/{id}', [AdminController::class, 'iklan_hapus'])->name('iklan.hapus')->middleware('admin');

Route::get('/admin/user', [AdminController::class, 'user'])->name('admin.user')->middleware('admin');
Route::get('/admin/user/{id}', [AdminController::class, 'user_detail'])->name('admin.user_detail')->middleware('admin');

Route::get('/admin/profile', [AdminController::class, 'profil'])->name('admin.profile')->middleware('admin');
Route::post('/admin/profil_action', [AdminController::class, 'profil_action'])->name('admin.profile.action')->middleware('admin');
Route::post('admin/password', [AdminController::class, 'password_action'])->name('password.action')->middleware('admin');
