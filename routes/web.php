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
Route::post('/umkm', [UmkmController::class, 'store'])->name('submit.umkm');
Route::get('/umkm', [UmkmController::class, 'index'])->name('landing_umkm');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/pengumuman', function () {
    return view('global.pengumuman');
})->name('landing_pengumuman');

// manage umkm
Route::get('/umkmm', [UmkmController::class, 'list'])->name('manage_umkm');
// Route::get('/umkm/{id}/edit', [UmkmController::class, 'edit'])->name('umkm.edit');
// Route::put('/umkm/{id}', [UmkmController::class, 'update'])->name('umkm.update');
Route::delete('/umkm/{id}', [UmkmController::class, 'destroy'])->name('umkm.destroy');



Route::get('/pengumumann', [PengumumanController::class, 'index'])->name('pengumuman.index');
Route::post('/pengumumann', [PengumumanController::class, 'store'])->name('pengumuman.store');
Route::delete('/pengumumann/{pengumuman}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');
Route::get('/pengumumann/{pengumuman}/edit', [PengumumanController::class, 'edit'])->name('pengumuman.edit');

// Route::get('/pengumuman/create', 'PengumumanController@create')->name('pengumuman.create');
// Route::post('/pengumuman/store', 'PengumumanController@store')->name('pengumuman.store');
// Route::get('/pengumuman/{pengumuman}/edit', 'PengumumanController@edit')->name('pengumuman.edit');
// Route::put('/pengumuman/{pengumuman}', 'PengumumanController@update')->name('pengumuman.update');
// Route::delete('/pengumuman/{pengumuman}', 'PengumumanController@destroy')->name('pengumuman.destroy');