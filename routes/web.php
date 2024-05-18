<?php

use App\Http\Controllers\DokumenController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LaporanKeuanganController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\PengajuanDokumenController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RWController;
use App\Http\Controllers\RTController;
use App\Http\Controllers\UsersController;
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
Route::prefix('umkm')->group(function() {
    Route::get('/', [UmkmController::class, 'index'])->name('umkm.global');
    Route::post('/', [UmkmController::class, 'store'])->name('umkm.store');
});

// global pengajuan dokumen
Route::prefix('pengajuandokumen')->group(function() {
    Route::post('/', [PengajuanDokumenController::class, 'store'])->name('pengajuandokumen.store');
    Route::get('/', [PengajuanDokumenController::class, 'index'])->name('pengajuandokumen.global');
});

// global pengumuman
Route::prefix('pengumuman')->group(function() {
    Route::get('/', [PengumumanController::class, 'index'])->name('pengumuman.global');
});

// global laporan keuangan
Route::prefix('laporankeuangan')->group(function() {
    Route::get('/', [LaporanKeuanganController::class, 'index'])->name('laporankeuangan.global');
});

// manage feature
Route::prefix('manage')->group(function(){
    // manage pengumuman
    Route::prefix('pengumuman')->group(function() {
        Route::get('/', [PengumumanController::class, 'list'])->name('pengumuman.manage')->middleware('isRw');
        Route::post('/', [PengumumanController::class, 'store'])->name('pengumuman.store')->middleware('isRw');
        Route::get('/edit/{pengumuman}', [PengumumanController::class, 'edit'])->name('pengumuman.edit')->middleware('isRw');
        Route::put('/update/{pengumuman}', [PengumumanController::class, 'update'])->name('pengumuman.update')->middleware('isRw');
        Route::delete('/{pengumuman}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy')->middleware('isRw');
    });

    // manage pengajuan dokumen
    Route::prefix('pengajuandokumen')->group(function() {
        Route::get('/', [PengajuanDokumenController::class, 'list'])->name('pengajuandokumen.manage')->middleware('auth');
        Route::get('/edit/{pengajuandokumen}', [PengajuanDokumenController::class, 'edit'])->name('pengajuandokumen.edit')->middleware('isRt');
        Route::put('/update/{pengajuandokumen}', [PengajuanDokumenController::class, 'update'])->name('pengajuandokumen.update')->middleware('isRt');
        Route::delete('/{pengajuandokumen}', [PengajuanDokumenController::class, 'destroy'])->name('pengajuandokumen.destroy')->middleware('isRt');
    });

    // manage laporan keuangan
    Route::prefix('laporankeuangan')->group(function() {
        Route::get('/', [LaporanKeuanganController::class, 'index'])->name('laporankeuangan.global');
        Route::get('/', [LaporanKeuanganController::class, 'list'])->name('laporankeuangan.manage')->middleware('isRw');
        Route::post('/', [LaporanKeuanganController::class, 'store'])->name('laporankeuangan.store')->middleware('isRw');
        Route::get('/edit/{laporankeuangan}', [LaporanKeuanganController::class, 'edit'])->name('laporankeuangan.edit')->middleware('isRw');
        Route::put('/update/{laporankeuangan}', [LaporanKeuanganController::class, 'update'])->name('laporankeuangan.update')->middleware('isRw');
        Route::delete('/{laporankeuangan}', [LaporanKeuanganController::class, 'destroy'])->name('laporankeuangan.destroy')->middleware('isRw');
    });

    // manage umkm
    Route::prefix('umkm')->group(function() {
        Route::get('/', [UmkmController::class, 'list'])->name('umkm.manage')->middleware('isRw');
        Route::get('/edit/{umkm}', [UmkmController::class, 'edit'])->name('umkm.edit')->middleware('isRw');
        Route::put('/update/{umkm}', [UmkmController::class, 'update'])->name('umkm.update')->middleware('isRw');
        Route::delete('/{umkm}', [UmkmController::class, 'destroy'])->name('umkm.destroy')->middleware('isRw');
    });

        // manage pendataan
    Route::prefix('pendataan')->group(function() {
        //manage rt
        Route::prefix('rt')->group(function() {
            Route::get('/', [RTController::class, 'list'])->name('rt.manage')->middleware('isRw');
            Route::post('/', [RTController::class, 'store'])->name('rt.store')->middleware('isRw');
            Route::get('/edit/{rt}', [RTController::class, 'edit'])->name('rt.edit')->middleware('isRw');
            Route::put('/update/{rt}', [RTController::class, 'update'])->name('rt.update')->middleware('isRw');
            Route::delete('/{rt}', [RTController::class, 'destroy'])->name('rt.destroy')->middleware('isRw');
        });

        //manage rw
        Route::prefix('rw')->group(function() {
            Route::get('/', [RWController::class, 'list'])->name('rw.manage')->middleware('isRw');
            Route::get('/{rw}/edit', [RWController::class, 'edit'])->name('rw.edit')->middleware('isRw');
            Route::post('/', [RWController::class, 'store'])->name('rw.store')->middleware('isRw');
            Route::delete('/{rw}', [RwController::class, 'destroy'])->name('rw.destroy')->middleware('isRw');
        });

        // manage penduduk
        Route::prefix('penduduk')->group(function() {
            Route::get('/', [PendudukController::class, 'list'])->name('penduduk.manage')->middleware('auth');
            Route::post('/', [PendudukController::class, 'store'])->name('penduduk.store')->middleware('auth');
            Route::get('/edit/{penduduk}', [PendudukController::class, 'edit'])->name('penduduk.edit')->middleware('auth');
            Route::put('/update/{penduduk}', [PendudukController::class, 'update'])->name('penduduk.update')->middleware('auth');
            Route::delete('/{penduduk}', [PendudukController::class, 'destroy'])->name('penduduk.destroy')->middleware('auth');
        });

        // manage keluarga
        Route::prefix('keluarga')->group(function() {
            Route::get('/', [KeluargaController::class, 'list'])->name('keluarga.manage')->middleware('auth');
            Route::post('/', [KeluargaController::class, 'store'])->name('keluarga.store')->middleware('auth');
            Route::get('/edit/{keluarga}', [KeluargaController::class, 'edit'])->name('keluarga.edit')->middleware('auth');
            Route::put('/update/{keluarga}', [KeluargaController::class, 'update'])->name('keluarga.update')->middleware('auth');
            Route::delete('/{keluarga}', [KeluargaController::class, 'destroy'])->name('keluarga.destroy')->middleware('auth');
        });
    });

        // manage user
    Route::prefix('users')->group(function() {
        Route::get('/', [UsersController::class, 'list'])->name('users.manage')->middleware('isRw');
        Route::post('/', [UsersController::class, 'store'])->name('users.store')->middleware('isRw');
        // Route::get('/edit/{users}', [UsersController::class, 'edit'])->name('users.edit')->middleware('isRw');
        Route::put('/update/{users}', [UsersController::class, 'update'])->name('users.update')->middleware('isRw');
        Route::delete('/{users}', [UsersController::class, 'destroy'])->name('users.destroy')->middleware('isRw');
    });

});

//dokumen
Route::prefix('dokumen')->group(function(){
    Route::get('/', [DokumenController::class, 'list'])->name('dokumen.manage')->middleware('isRw');
    Route::post('/', [DokumenController::class, 'store'])->name('dokumen.store')->middleware('isRw');
    Route::get('/edit/{dokumen}', [DokumenController::class, 'edit'])->name('dokumen.edit')->middleware('isRw');
    Route::put('/update/{dokumen}', [DokumenController::class, 'update'])->name('dokumen.update')->middleware('isRw');
    Route::delete('/{dokumen}', [DokumenController::class, 'destroy'])->name('dokumen.destroy')->middleware('isRw');
});



Route::prefix('profil')->group(function() {
    Route::get('/', [ProfilController::class, 'profil'])->name('profil.manage')->middleware('auth');
    Route::put('/update/{users}', [ProfilController::class, 'updateProfil'])->name('profil.update')->middleware('auth');
    // Route::put('/{user}/change_password', [ProfilController::class, 'changePassword'])->name('profil.password');
});
