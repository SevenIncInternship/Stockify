<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManajerDashboardController;

Route::middleware(['auth', 'role:manajer'])
    ->prefix('manajer')
    ->name('manajer.')
    ->group(function () {
        Route::get('/dashboard', [ManajerDashboardController::class, 'index'])->name('dashboard');

        // Tambahkan rute lain sesuai kebutuhan
    });
