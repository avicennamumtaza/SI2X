<?php

use App\Http\Controllers\LaporanKeuanganController;
use App\Http\Controllers\PengajuanDokumenController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\PengumumanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing');
})->name('landing');

// Route::get('/umkm', function () {
//     return view('global.umkm');
// })->name('umkm');
// request umkm

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// global umkm
Route::post('/umkm', [UmkmController::class, 'store'])->name('umkm.submit');
Route::get('/umkm', [UmkmController::class, 'index'])->name('umkm.global');

// manage umkm
Route::get('/umkmm', [UmkmController::class, 'list'])->name('umkm.manage');
// Route::get('/umkm/{id}/edit', [UmkmController::class, 'edit'])->name('umkm.edit');
// Route::put('/umkm/{id}', [UmkmController::class, 'update'])->name('umkm.update');
Route::delete('/umkm/{id}', [UmkmController::class, 'destroy'])->name('umkm.destroy');

// global pengumuman
Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.global');

// manage pengumuman
Route::get('/pengumumann', [PengumumanController::class, 'list'])->name('pengumuman.manage');
Route::post('/pengumumann', [PengumumanController::class, 'store'])->name('pengumuman.store');
Route::get('/pengumumann/{pengumuman}/edit', [PengumumanController::class, 'edit'])->name('pengumuman.edit');
Route::put('/pengumumann/{pengumuman}', [PengumumanController::class, 'update'])->name('pengumuman.update');
Route::delete('/pengumumann/{pengumuman}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');

// global pengajuan dokumen
Route::get('/pengajuandokumen', [PengajuanDokumenController::class, 'index'])->name('pengajuandokumen.global');

// manage pengajuan dokumen
// Route::get('/laporankeuangann', [LaporanKeuanganController::class, 'list'])->name('laporankeuangan.manage');

// global laporan keuangan
Route::get('/laporankeuangan', [LaporanKeuanganController::class, 'index'])->name('laporankeuangan.global');

// manage laporan keuangan
Route::get('/laporankeuangann', [LaporanKeuanganController::class, 'list'])->name('laporankeuangan.manage');
Route::post('/laporankeuangann', [LaporanKeuanganController::class, 'store'])->name('laporankeuangan.store');
Route::delete('/laporankeuangann', [LaporanKeuanganController::class, 'destroy'])->name('laporankeuangan.destroy');