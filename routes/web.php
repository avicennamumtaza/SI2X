<?php

use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\LaporanKeuanganController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\PengajuanDokumenController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\RWController;
use App\Http\Controllers\RTController;
use App\Models\PengajuanDokumen;
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

Route::get('/home', [App\Http\Controllers\PengajuanDokumenController::class, 'list'])->name('home');
Route::get('/rt', function () {
    return view('auth.rt.dashboard');
});
Route::get('/rw', function () {
    return view('auth.rw.dashboard');
});
Route::get('/home', [App\Http\Controllers\PengajuanDokumenController::class, 'list'])->name('home');

// global umkm
Route::post('/umkm', [UmkmController::class, 'store'])->name('umkm.store');
Route::get('/umkm', [UmkmController::class, 'index'])->name('umkm.global');

// manage umkm
Route::get('/umkmm', [UmkmController::class, 'list'])->name('umkm.manage');
Route::get('/umkmm/edit/{umkm}', [UmkmController::class, 'edit'])->name('umkm.edit');
Route::put('/umkmm/update/{umkm}', [UmkmController::class, 'update'])->name('umkm.update');
Route::delete('/umkmm/{umkm}', [UmkmController::class, 'destroy'])->name('umkm.destroy');

// global pengumuman
Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.global');

// manage pengumuman
Route::get('/pengumumann', [PengumumanController::class, 'list'])->name('pengumuman.manage');
Route::post('/pengumumann', [PengumumanController::class, 'store'])->name('pengumuman.store');
Route::get('/pengumumann/edit/{pengumuman}', [PengumumanController::class, 'edit'])->name('pengumuman.edit');
Route::put('/pengumumann/update/{pengumuman}', [PengumumanController::class, 'update'])->name('pengumuman.update');
Route::delete('/pengumumann/{pengumuman}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');

// global pengajuan dokumen
Route::post('/pengajuandokumen', [PengajuanDokumenController::class, 'store'])->name('pengajuandokumen.store');
Route::get('/pengajuandokumen', [PengajuanDokumenController::class, 'index'])->name('pengajuandokumen.global');

// manage pengajuan dokumen
Route::get('/pengajuandokumenn', [PengajuanDokumenController::class, 'list'])->name('pengajuandokumen.manage');
Route::get('/pengajuandokumenn/edit/{pengajuandokumen}', [PengajuanDokumenController::class, 'edit'])->name('pengajuandokumen.edit');
Route::put('/pengajuandokumenn/update/{pengajuandokumen}', [PengajuanDokumenController::class, 'update'])->name('pengajuandokumen.update');
Route::delete('/pengajuandokumenn/{pengajuandokumen}', [PengajuanDokumenController::class, 'destroy'])->name('pengajuandokumen.destroy');

// global laporan keuangan
Route::get('/laporankeuangan', [LaporanKeuanganController::class, 'index'])->name('laporankeuangan.global');

// manage laporan keuangan
Route::get('/laporankeuangann', [LaporanKeuanganController::class, 'list'])->name('laporankeuangan.manage');
Route::post('/laporankeuangann', [LaporanKeuanganController::class, 'store'])->name('laporankeuangan.store');
Route::get('/laporankeuangann/edit/{laporankeuangan}', [LaporanKeuanganController::class, 'edit'])->name('laporankeuangan.edit');
Route::put('/laporankeuangann/update/{laporankeuangan}', [LaporanKeuanganController::class, 'update'])->name('laporankeuangan.update');
Route::delete('/laporankeuangann/{laporankeuangan}', [LaporanKeuanganController::class, 'destroy'])->name('laporankeuangan.destroy');

// manage penduduk
Route::get('/penduduk', [PendudukController::class, 'list'])->name('penduduk.manage');
Route::post('/penduduk', [PendudukController::class, 'store'])->name('penduduk.store');
Route::get('/penduduk/edit/{penduduk}', [PendudukController::class, 'edit'])->name('penduduk.edit');
Route::put('/penduduk/update/{penduduk}', [PendudukController::class, 'update'])->name('penduduk.update');
Route::delete('/penduduk/{penduduk}', [PendudukController::class, 'destroy'])->name('penduduk.destroy');

// manage keluarga
Route::get('/keluarga', [KeluargaController::class, 'list'])->name('keluarga.manage');
Route::post('/keluarga', [KeluargaController::class, 'store'])->name('keluarga.store');
Route::get('/keluarga/{keluarga}/edit', [KeluargaController::class, 'edit'])->name('keluarga.edit');
Route::put('/keluarga/{keluarga}', [KeluargaController::class, 'update'])->name('keluarga.update');
Route::delete('/keluarga/{keluarga}', [KeluargaController::class, 'destroy'])->name('keluarga.destroy');
// manage pendataan
Route::get('/pendataan/rt', [RTController::class, 'list'])->name('rt.manage');
Route::get('/pendataan/rt/{rt}/edit', [RTController::class, 'edit'])->name('rt.edit');
Route::post('/pendataan/rt', [RTController::class, 'store'])->name('rt.store');
Route::delete('/pendataan/rt/{rt}', [RTController::class, 'destroy'])->name('rt.destroy');

Route::get('/pendataan/rw', [RWController::class, 'list'])->name('rw.manage');
Route::get('/pendataan/rw/{rw}/edit', [RWController::class, 'edit'])->name('rw.edit');
Route::post('/pendataan/rw', [RWController::class, 'store'])->name('rw.store');
Route::delete('/pendataan/rw/{rw}', [RwController::class, 'destroy'])->name('rw.destroy');