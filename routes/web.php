<?php

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

// global
Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.global');

// manage pengumuman
Route::get('/pengumumann', [PengumumanController::class, 'list'])->name('pengumuman.manage');
Route::post('/pengumumann', [PengumumanController::class, 'store'])->name('pengumuman.store');
// Route::get('/pengumumann/{pengumuman}/edit', [PengumumanController::class, 'edit'])->name('pengumuman.edit');
Route::delete('/pengumumann/{pengumuman}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');