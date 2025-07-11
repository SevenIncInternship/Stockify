<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffDashboardController;
use App\Http\Controllers\StaffBarangMasukController;
use App\Http\Controllers\StaffBarangKeluarController;

Route::middleware(['auth', 'role:staff'])
    ->prefix('staff')
    ->name('staff.')
    ->group(function () {
        Route::get('/dashboard', [StaffDashboardController::class, 'index'])->name('dashboard');

        Route::get('/barang_masuk/{id}/konfirmasi', [StaffBarangMasukController::class, 'konfirmasi'])->name('barangMasuk.konfirmasi');
        Route::put('/barang_masuk/{id}/konfirmasi', [StaffBarangMasukController::class, 'update'])->name('barangMasuk.update_konfirmasi');

        Route::get('/barang_keluar/{id}/konfirmasi', [StaffBarangKeluarController::class, 'konfirmasi'])->name('barangKeluar.konfirmasi');
        Route::put('/barang_keluar/{id}/konfirmasi', [StaffBarangKeluarController::class, 'update'])->name('barangKeluar.update_konfirmasi');
    });
