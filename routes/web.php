<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Admin\DashboardAdminController;

Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->role === 'admin' 
            ? redirect()->route('dashboard.admin') 
            : redirect('/dashboard');
    }
    return redirect()->route('login');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard.admin');

    Route::get('/admin/pegawai', [PegawaiController::class, 'index'])->name('admin.pegawai.index');
    Route::get('/admin/pegawai/tambah-pegawai', [PegawaiController::class, 'create'])->name('admin.pegawai.create');
    Route::post('/admin/pegawai/tambah-pegawai', [PegawaiController::class, 'store'])->name('admin.pegawai.store');
    Route::get('/admin/pegawai/edit/{id_pegawai}', [PegawaiController::class, 'edit'])->name('admin.pegawai.edit');
    Route::post('/admin/pegawai/update/{id_pegawai}', [PegawaiController::class, 'update'])->name('admin.pegawai.update');
    Route::delete('/admin/pegawai/hapus/{id_pegawai}', [PegawaiController::class, 'storeHapusPegawai'])->name('admin.pegawai.destroy');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'viewLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'storeLogin'])->name('store.login');
});
