<?php

use App\Http\AuthController;
use App\Http\Controllers\Admin\PegawaiController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard-admin');
    })->name('dashboard.admin');

    Route::get('/admin/pegawai', [PegawaiController::class, 'index'])->name('admin.pegawai.index');
    Route::get('/admin/pegawai/tambah-pegawai', [PegawaiController::class, 'create'])->name('admin.pegawai.create');
    Route::post('/admin/pegawai/tambah-pegawai', [PegawaiController::class, 'store'])->name('admin.pegawai.store');
});

Route::get('/login', [AuthController::class, 'viewLogin'])->name('login');
Route::post('/login', [AuthController::class, 'storeLogin'])->name('store.login');
