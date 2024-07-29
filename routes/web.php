<?php

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

require __DIR__ . '/auth.php';
