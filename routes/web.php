<?php

use App\Http\Controllers\DownloadController;
use App\Http\Controllers\GrafikController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/beranda', [WargaController::class, 'web_warga_index'])
    ->middleware(['auth', 'verified'])
    ->name('warga.beranda');

Route::get('/unduh-data', [WargaController::class, 'web_warga_data_download'])
    ->middleware(['auth', 'verified'])
    ->name('warga.unduh-data');

Route::get('/tambah-data', [WargaController::class, 'web_warga_add'])
    ->middleware(['auth', 'verified'])
    ->name('warga.tambah');

Route::get('/edit-data', [WargaController::class, 'web_warga_edit_index'])
    ->middleware(['auth', 'verified'])
    ->name('warga.edit-index');

Route::get('/admin-profile', [WargaController::class, 'web_admin_profile'])
    ->middleware(['auth', 'verified'])
    ->name('admin.profile');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route untuk GrafikController
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/grafik/gender', [GrafikController::class, 'grafik_gender'])->name('grafik.gender');
    Route::get('/grafik/status-pkh', [GrafikController::class, 'grafik_pkh'])->name('grafik.pkh');
    Route::get('/grafik/status-ktp', [GrafikController::class, 'grafik_ktp'])->name('grafik.ktp');
    Route::get('/grafik/status-akta-lahir', [GrafikController::class, 'grafik_akta_lahir'])->name('grafik.akta_lahir');
    Route::get('/grafik/status-jkn', [GrafikController::class, 'grafik_jkn'])->name('grafik.jkn');
    Route::get('/grafik/umur-laki', [GrafikController::class, 'grafik_umur_laki'])->name('grafik.umur_laki');
    Route::get('/grafik/umur-perempuan', [GrafikController::class, 'grafik_umur_perempuan'])->name('grafik.umur_perempuan');
});

// Route untuk export data sensus (Keluarga dan Warga)
// TODO Tolong nanti dikemas dalam middleware (By Muhammad)
Route::get('export-keluarga/{tahun_data}', [DownloadController::class, 'keluarga_export'])->name('keluarga.export');
Route::get('export-warga/{tahun_data}', [DownloadController::class, 'warga_export'])->name('warga.export');

require __DIR__ . '/auth.php';
