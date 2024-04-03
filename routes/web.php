<?php

use App\Http\Controllers\UmkmController;
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
Route::post('/submit-umkm', [UmkmController::class, 'submitUmkm'])->name('submit.umkm');
Route::get('/umkm', [UmkmController::class, 'index'])->name('landing_umkm');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// manage umkm
Route::get('/umkmm', [UmkmController::class, 'showAllUmkm'])->name('manage_umkm');
// Route::get('/umkm/{id}/edit', [UmkmController::class, 'edit'])->name('umkm.edit');
// Route::put('/umkm/{id}', [UmkmController::class, 'update'])->name('umkm.update');
Route::delete('/umkm/{id}', [UmkmController::class, 'destroy'])->name('umkm.destroy');