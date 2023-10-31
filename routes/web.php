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
    BmnSuratMasukController,
    DashboardController as BMNDashboardController
};
use App\Http\Controllers\Kesyahbandaran\{
    DashboardController as KesyahbandaranDashboardController,
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
    DashboardController,
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
    DashboardController as PelabuhanDashboardController,
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
    DashboardController as TUDashboardController,
    TuDisposisiController,
    TuKontrakKerjaSamaController,
    TuSuratKeluarController,
    TuSuratMasukController,
    TuSuratTugasController
};
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

Route::middleware('auth')->group(function () {
    Route::get('download/{pathToImage}', function (string $pathToImage) {
        return FileHelper::download($pathToImage);
    })->where('pathToImage', '.*')->name('download');

    Route::get('zip/{ids?}/{model}', function ($ids, $model) {
        if ($ids) {
            $data = DB::table($model)->whereIn('id', explode(',', $ids))->pluck('lampiran')->toArray();
            if (count($data) != 0) {
                $fileName = Carbon::now()->format('Y-M-d') . " $model.zip";
                return FileHelper::zip($fileName, $data);
            }
        }
    })->name('export-data');

    Route::middleware(['role:admin'])->group(function () {
        Route::get('user-dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
        Route::resource('user', UserController::class);
    });

    Route::middleware(['role:bidang keuangan'])->group(function () {
        Route::get('keu-dashboard', [DashboardController::class, 'index'])->name('keu.dashboard');
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
        Route::get('kesya-dashboard', [KesyahbandaranDashboardController::class, 'index'])->name('kesya.dashboard');
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
        Route::get('bmn-dashboard', [BMNDashboardController::class, 'index'])->name('bmn.dashboard');
        Route::resource('bmn-surat-masuk', BmnSuratMasukController::class);
        Route::resource('bmn-surat-masuk.disposisi', BmnDisposisiController::class)->except(['index', 'show']);
        Route::resource('bmn-surat-keluar', BmnSuratKeluarController::class);
        Route::resource('bmn-bendahara-materil', BmnBendaharaMaterilController::class);
        Route::resource('bmn-smart-uup-benete', BmnSmartUupBeneteController::class);
    });

    Route::middleware(['role:bidang kepegawaian atau tata usaha'])->group(function () {
        Route::get('tu-dashboard', [TUDashboardController::class, 'index'])->name('tu.dashboard');
        Route::resource('tu-surat-masuk', TuSuratMasukController::class);
        Route::resource('tu-surat-masuk.disposisi', TuDisposisiController::class)->except(['index', 'show']);
        Route::resource('tu-surat-keluar', TuSuratKeluarController::class);
        Route::resource('tu-surat-tugas', TuSuratTugasController::class);
        Route::resource('tu-kontrak-kerja-sama', TuKontrakKerjaSamaController::class);
    });

    Route::middleware(['role:bidang kepelabuhan'])->group(function () {
        Route::get('pelabuhan-dashboard', [PelabuhanDashboardController::class, 'index'])->name('pelabuhan.dashboard');
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
});
