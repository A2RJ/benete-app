<?php

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
    return view('welcome');
});

Auth::routes();
Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/users', App\Http\Controllers\UserController::class);
Route::resource('/keu-surat-masuk', App\Http\Controllers\KeuSuratMasukController::class);
Route::resource('/keu-surat-keluar', App\Http\Controllers\KeuSuratKeluarController::class);
Route::resource('/keu-bendahara-pengeluaran', App\Http\Controllers\KeuBendaharaPengeluaranController::class);
Route::resource('/keu-bendahara-penerimaan', App\Http\Controllers\KeuBendaharaPenerimaanController::class);
Route::resource('/keu-pejabat-pengadaan', App\Http\Controllers\KeuPejabatPengadaanController::class);
Route::resource('/keu-ppk', App\Http\Controllers\KeuPpkController::class);
Route::resource('/keu-kuasa-pengguna-anggaran', App\Http\Controllers\KeuKuasaPenggunaAnggaranController::class);
