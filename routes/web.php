<?php

use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LaporanKeuanganController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\PengajuanDokumenController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\RWController;
use App\Http\Controllers\RTController;
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

Route::get('/', [LandingController::class, 'index'])->name('landing');

// Route::get('/umkm', function () {
//     return view('global.umkm');
// })->name('umkm');
// request umkm

Auth::routes();

// Route::get('/home', function() {
//     return view('auth.rw.dashboard');
// })->name('dashboard');

// Route::get('/rt', function () {
//     return view('auth.rt.dashboard');
// })->name('rt.dashboard')->middleware('isRt');

// Route::get('/rw', function () {
//     return view('auth.rw.dashboard');
// })->name('rw.dashboard')->middleware('isRw');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// global umkm
Route::post('/umkm', [UmkmController::class, 'store'])->name('umkm.store');
Route::get('/umkm', [UmkmController::class, 'index'])->name('umkm.global');
// manage umkm
Route::get('/umkmm', [UmkmController::class, 'list'])->name('umkm.manage')->middleware('isRw');
Route::get('/umkmm/edit/{umkm}', [UmkmController::class, 'edit'])->name('umkm.edit')->middleware('isRw');
Route::put('/umkmm/update/{umkm}', [UmkmController::class, 'update'])->name('umkm.update')->middleware('isRw');
Route::delete('/umkmm/{umkm}', [UmkmController::class, 'destroy'])->name('umkm.destroy')->middleware('isRw');

// global pengajuan dokumen
Route::post('/pengajuandokumen', [PengajuanDokumenController::class, 'store'])->name('pengajuandokumen.store');
Route::get('/pengajuandokumen', [PengajuanDokumenController::class, 'index'])->name('pengajuandokumen.global');
// manage pengajuan dokumen
Route::get('/pengajuandokumenn', [PengajuanDokumenController::class, 'list'])->name('pengajuandokumen.manage')->middleware('isRt');
Route::get('/pengajuandokumenn/edit/{pengajuandokumen}', [PengajuanDokumenController::class, 'edit'])->name('pengajuandokumen.edit')->middleware('isRt');
Route::put('/pengajuandokumenn/update/{pengajuandokumen}', [PengajuanDokumenController::class, 'update'])->name('pengajuandokumen.update')->middleware('isRt');
Route::delete('/pengajuandokumenn/{pengajuandokumen}', [PengajuanDokumenController::class, 'destroy'])->name('pengajuandokumen.destroy')->middleware('isRt');

// global pengumuman
Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.global');
// manage pengumuman
Route::get('/pengumumann', [PengumumanController::class, 'list'])->name('pengumuman.manage')->middleware('isRw');
Route::post('/pengumumann', [PengumumanController::class, 'store'])->name('pengumuman.store')->middleware('isRw');
Route::get('/pengumumann/edit/{pengumuman}', [PengumumanController::class, 'edit'])->name('pengumuman.edit')->middleware('isRw');
Route::put('/pengumumann/update/{pengumuman}', [PengumumanController::class, 'update'])->name('pengumuman.update')->middleware('isRw');
Route::delete('/pengumumann/{pengumuman}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy')->middleware('isRw');

// global laporan keuangan
Route::get('/laporankeuangan', [LaporanKeuanganController::class, 'index'])->name('laporankeuangan.global');
// manage laporan keuangan
Route::get('/laporankeuangann', [LaporanKeuanganController::class, 'list'])->name('laporankeuangan.manage')->middleware('isRw');
Route::post('/laporankeuangann', [LaporanKeuanganController::class, 'store'])->name('laporankeuangan.store')->middleware('isRw');
Route::get('/laporankeuangann/edit/{laporankeuangan}', [LaporanKeuanganController::class, 'edit'])->name('laporankeuangan.edit')->middleware('isRw');
Route::put('/laporankeuangann/update/{laporankeuangan}', [LaporanKeuanganController::class, 'update'])->name('laporankeuangan.update')->middleware('isRw');
Route::delete('/laporankeuangann/{laporankeuangan}', [LaporanKeuanganController::class, 'destroy'])->name('laporankeuangan.destroy')->middleware('isRw');

// manage penduduk
Route::get('/penduduk', [PendudukController::class, 'list'])->name('penduduk.manage')->middleware('auth');
Route::post('/penduduk', [PendudukController::class, 'store'])->name('penduduk.store')->middleware('auth');
Route::get('/penduduk/edit/{penduduk}', [PendudukController::class, 'edit'])->name('penduduk.edit')->middleware('auth');
Route::put('/penduduk/update/{penduduk}', [PendudukController::class, 'update'])->name('penduduk.update')->middleware('auth');
Route::delete('/penduduk/{penduduk}', [PendudukController::class, 'destroy'])->name('penduduk.destroy')->middleware('auth');

// manage keluarga
Route::get('/keluarga', [KeluargaController::class, 'list'])->name('keluarga.manage')->middleware('auth');
Route::post('/keluarga', [KeluargaController::class, 'store'])->name('keluarga.store')->middleware('auth');
Route::get('/keluarga/{keluarga}/edit', [KeluargaController::class, 'edit'])->name('keluarga.edit')->middleware('auth');
Route::put('/keluarga/{keluarga}', [KeluargaController::class, 'update'])->name('keluarga.update')->middleware('auth');
Route::delete('/keluarga/{keluarga}', [KeluargaController::class, 'destroy'])->name('keluarga.destroy')->middleware('auth');

// manage rt
Route::get('/pendataan/rt', [RTController::class, 'list'])->name('rt.manage')->middleware('isRw');
Route::get('/pendataan/rt/{rt}/edit', [RTController::class, 'edit'])->name('rt.edit')->middleware('isRw');
Route::post('/pendataan/rt', [RTController::class, 'store'])->name('rt.store')->middleware('isRw');
Route::delete('/pendataan/rt/{rt}', [RTController::class, 'destroy'])->name('rt.destroy')->middleware('isRw');

// manage rw
Route::get('/pendataan/rw', [RWController::class, 'list'])->name('rw.manage')->middleware('isRw');
Route::get('/pendataan/rw/{rw}/edit', [RWController::class, 'edit'])->name('rw.edit')->middleware('isRw');
Route::post('/pendataan/rw', [RWController::class, 'store'])->name('rw.store')->middleware('isRw');
Route::delete('/pendataan/rw/{rw}', [RwController::class, 'destroy'])->name('rw.destroy')->middleware('isRw');