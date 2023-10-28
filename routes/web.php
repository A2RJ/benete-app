<?php

use App\Helpers\FileHelper;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BMN\{
    BmnBendaharaMaterilController,
    BmnDisposisiController,
    BmnSmartUupBeneteController,
    BmnSuratKeluarController,
    BmnSuratMasukController
};
use App\Http\Controllers\Kesyahbandaran\{
    KesyaDisposisiController,
    KesyaDokumenAwakKapalController,
    KesyaDokumenKapalController,
    KesyahController,
    KesyaPatroliController,
    KesyaSuratKeluarController,
    KesyaSuratMasukController,
    KesyaTertibBanarController
};
use App\Http\Controllers\Keuangan\{
    KeuBendaharaPenerimaanController,
    KeuBendaharaPengeluaranController,
    KeuDisposisiController,
    KeuKuasaPenggunaAnggaranController,
    KeuPejabatPengadaanController,
    KeuPpkController,
    KeuSuratKeluarController,
    KeuSuratMasukController,
};
use App\Http\Controllers\Pelabuhan\{
    PelabuhanDisposisiController,
    PelabuhanFasilitasPelabuhanController,
    PelabuhanJptController,
    PelabuhanKeagenanController,
    PelabuhanLalaController,
    PelabuhanPbmController,
    PelabuhanSuratKeluarController,
    PelabuhanSuratMasukController,
    PelabuhanTkbmController,
};
use App\Http\Controllers\TU\{
    TuDisposisiController,
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

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::middleware('auth')->group(function () {
        Route::get('/home', 'home')->name('dashboard');
        Route::get('edit-profile', 'edit')->name('edit.profile');
        Route::post('update-profile', 'update')->name('update.profile');
        Route::post('logout', 'logout')->name('logout');
    });
});

Route::middleware('auth')->get('download/{pathToImage}', function (string $pathToImage) {
    return FileHelper::download($pathToImage);
})->where('pathToImage', '.*')->name('download');

Route::middleware(['role:admin'])->group(function () {
    Route::resource('user', UserController::class);
});

Route::middleware(['role:bidang keuangan'])->group(function () {
    Route::resource('keu-surat-masuk', KeuSuratMasukController::class);
    Route::resource('keu-surat-masuk.disposisi', KeuDisposisiController::class)->except(['index', 'show']);
    Route::resource('keu-surat-keluar', KeuSuratKeluarController::class);
    Route::resource('keu-bendahara-pengeluaran', KeuBendaharaPengeluaranController::class);
    Route::resource('keu-bendahara-penerimaan', KeuBendaharaPenerimaanController::class);
    Route::resource('keu-pejabat-pengadaan', KeuPejabatPengadaanController::class);
    Route::resource('keu-ppk', KeuPpkController::class);
    Route::resource('keu-kuasa-pengguna-anggaran', KeuKuasaPenggunaAnggaranController::class);
});

Route::middleware(['role:bidang kesyahbandaran'])->group(function () {
    Route::resource('kesya-surat-masuk', KesyaSuratMasukController::class);
    Route::resource('kesya-surat-masuk.disposisi', KesyaDisposisiController::class)->except(['index', 'show']);
    Route::resource('kesya-surat-keluar', KesyaSuratKeluarController::class);
    Route::resource('kesyahbandaran', KesyahController::class);
    Route::resource('kesya-tertib-banar', KesyaTertibBanarController::class);
    Route::resource('kesya-patroli', KesyaPatroliController::class);
    Route::resource('kesya-dokumen-kapal', KesyaDokumenKapalController::class);
    Route::resource('kesya-dokumen-awak-kapal', KesyaDokumenAwakKapalController::class);
});

Route::middleware(['role:bidang pengelola bmn dan persediaan'])->group(function () {
    Route::resource('bmn-surat-masuk', BmnSuratMasukController::class);
    Route::resource('bmn-surat-masuk.disposisi', BmnDisposisiController::class)->except(['index', 'show']);
    Route::resource('bmn-surat-keluar', BmnSuratKeluarController::class);
    Route::resource('bmn-bendahara-materil', BmnBendaharaMaterilController::class);
    Route::resource('bmn-smart-uup-benete', BmnSmartUupBeneteController::class);
});

Route::middleware(['role:bidang kepegawaian atau tata usaha'])->group(function () {
    Route::resource('tu-surat-masuk', TuSuratMasukController::class);
    Route::resource('tu-surat-masuk.disposisi', TuDisposisiController::class)->except(['index', 'show']);
    Route::resource('tu-surat-keluar', TuSuratKeluarController::class);
    Route::resource('tu-surat-tugas', TuSuratTugasController::class);
    Route::resource('tu-kontrak-kerja-sama', TuKontrakKerjaSamaController::class);
});

Route::middleware(['role:bidang kepelabuhan'])->group(function () {
    Route::resource('pelabuhan-surat-masuk', PelabuhanSuratMasukController::class);
    Route::resource('pelabuhan-surat-masuk.disposisi', PelabuhanDisposisiController::class)->except(['index', 'show']);
    Route::resource('pelabuhan-surat-keluar', PelabuhanSuratKeluarController::class);
    Route::resource('pelabuhan-lala', PelabuhanLalaController::class);
    Route::resource('pelabuhan-fasilitas-pelabuhan', PelabuhanFasilitasPelabuhanController::class);
    Route::resource('pelabuhan-keagenan', PelabuhanKeagenanController::class);
    Route::resource('pelabuhan-pbm', PelabuhanPbmController::class);
    Route::resource('pelabuhan-jpt', PelabuhanJptController::class);
    Route::resource('pelabuhan-tkbm', PelabuhanTkbmController::class);
});
