<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BMN\{
    BmnBendaharaMaterilController,
    BmnPengelolaBmnController,
    BmnSmartUupBeneteController,
    BmnSuratKeluarController,
    BmnSuratMasukController
};
use App\Http\Controllers\Kesyabandaraan\{
    KesyabandaranController,
    KesyaDokumenAwakKapalController,
    KesyaDokumenKapalController,
    KesyaPatroliController,
    KesyaSuratKeluarController,
    KesyaSuratMasukController,
    KesyaTertibBanarController
};
use App\Http\Controllers\Keuangan\{
    KeuBendaharaPenerimaanController,
    KeuBendaharaPengeluaranController,
    KeuKuasaPenggunaAnggaranController,
    KeuPejabatPengadaanController,
    KeuPpkController,
    KeuSuratKeluarController,
    KeuSuratMasukController,
};
use App\Http\Controllers\Pelabuhan\{
    PelabuhanFasilitasPelabuhanController,
    PelabuhanKeagenanController,
    PelabuhanLalaController,
    PelabuhanPbmController,
    PelabuhanSuratKeluarController,
    PelabuhanSuratMasukController,
    PelabuhanTkbmController,
};
use App\Http\Controllers\TU\{
    TuKontrakKerjaSamaController,
    TuSuratKeluarController,
    TuSuratMasukController,
    TuSuratTugasController
};

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
    return view('auth.login');
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('/users', UserController::class);

Route::resource('/keu-surat-masuk', KeuSuratMasukController::class);
Route::resource('/keu-surat-keluar', KeuSuratKeluarController::class);
Route::resource('/keu-bendahara-pengeluaran', KeuBendaharaPengeluaranController::class);
Route::resource('/keu-bendahara-penerimaan', KeuBendaharaPenerimaanController::class);
Route::resource('/keu-pejabat-pengadaan', KeuPejabatPengadaanController::class);
Route::resource('/keu-ppk', KeuPpkController::class);
Route::resource('/keu-kuasa-pengguna-anggaran', KeuKuasaPenggunaAnggaranController::class);

Route::resource('/kesya-surat-masuk', KesyaSuratMasukController::class);
Route::resource('/kesya-surat-keluar', KesyaSuratKeluarController::class);
Route::resource('/kesyabandaran', KesyabandaranController::class);
Route::resource('/kesya-tertib-banar', KesyaTertibBanarController::class);
Route::resource('/kesya-patroli', KesyaPatroliController::class);
Route::resource('/kesya-dokumen-kapal', KesyaDokumenKapalController::class);
Route::resource('/kesya-dokumen-awak-kapal', KesyaDokumenAwakKapalController::class);

Route::resource('/bmn-surat-masuk', BmnSuratMasukController::class);
Route::resource('/bmn-surat-keluar', BmnSuratKeluarController::class);
Route::resource('/bmn-bendahara-materil', BmnBendaharaMaterilController::class);
Route::resource('/bmn-pengelola-bmn', BmnPengelolaBmnController::class);
Route::resource('/bmn-smart-uup-benete', BmnSmartUupBeneteController::class);

Route::resource('/tu-surat-masuk', TuSuratMasukController::class);
Route::resource('/tu-surat-keluar', TuSuratKeluarController::class);
Route::resource('/tu-surat-tugas', TuSuratTugasController::class);
Route::resource('/tu-kontrak-kerja-sama', TuKontrakKerjaSamaController::class);

Route::resource('/pelabuhan-surat-masuk', PelabuhanSuratMasukController::class);
Route::resource('/pelabuhan-surat-keluar', PelabuhanSuratKeluarController::class);
Route::resource('/pelabuhan-lala', PelabuhanLalaController::class);
Route::resource('/pelabuhan-fasilitas-pelabuhan', PelabuhanFasilitasPelabuhanController::class);
Route::resource('/pelabuhan-keagenan', PelabuhanKeagenanController::class);
Route::resource('/pelabuhan-pbm', PelabuhanPbmController::class);
Route::resource('/pelabuhan-tkbm', PelabuhanTkbmController::class);
