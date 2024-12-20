<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StokBarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;

Auth::routes();

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/', [HomeController::class, 'index'])->name('home.dashboard');

    // Barang masuk routes
    Route::get('/barang-masuk', [BarangMasukController::class, 'index'])->name('barang-masuk.index');
    Route::get('/barang-masuk/create', [BarangMasukController::class, 'create'])->name('barang-masuk.create');
    Route::post('/barang-masuk', [BarangMasukController::class, 'store'])->name('barang-masuk.store');
    Route::delete('/barang-masuk/delete/{id}', [BarangMasukController::class, 'destroy'])->name('barang-masuk.destroy');
    Route::post('/barang-masuk/excel', [BarangMasukController::class, 'barangMasukExcel'])->name('barang-masuk.excel');
    Route::post('/barangmasuk/import', [BarangMasukController::class, 'barangMasukImport'])->name('barang-masuk.import');
    
    // Barang keluar routes
    Route::get('/barang-keluar', [BarangKeluarController::class, 'index'])->name('barang-keluar.index');
    Route::get('/barang-keluar/create', [BarangKeluarController::class, 'create'])->name('barang-keluar.create');
    Route::post('/barang-keluar', [BarangKeluarController::class, 'store'])->name('barang-keluar.store');
    Route::delete('/barang-keluar/delete/{id}', [BarangKeluarController::class, 'destroy'])->name('barang-keluar.destroy');
    Route::post('/barang-keluar/excel', [BarangKeluarController::class, 'barangKeluarExcel'])->name('barang-keluar.excel');

    // Stok barang routes
    Route::get('/stok-barang', [StokBarangController::class, 'index'])->name('stok-barang.index');
    Route::get('/stok-barang/{id}', [StokBarangController::class, 'show'])->name('stok-barang.show');
    Route::post('/stok-barang/excel', [StokBarangController::class, 'stokBarangExcel'])->name('stok-barang.excel');

    // Profile routes
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::get('profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::get('profile/change-password', [UserController::class, 'editPassword'])->name('profile.editPassword');
    Route::put('profile/update-password', [UserController::class, 'updatePassword'])->name('profile.updatePassword');

    // Notifications routes
    Route::post('/readall', [NotificationController::class, 'store'])->name('storeNotification');
    Route::post('/readnotif/{id}', [NotificationController::class, 'update'])->name('updateNotification');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notif');
});

Route::get('/tes', function () {
    return "tes";
});