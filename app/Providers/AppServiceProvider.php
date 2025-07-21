<?php

namespace App\Providers;

use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Observers\BarangMasukObserver;
use App\Observers\BarangKeluarObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade; // Impor facade Blade

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Mendaftarkan komponen Blade X-Admin Stat Card
        // 'admin.stat-card' adalah alias yang akan digunakan di Blade (misal: <x-admin.stat-card />)
        // 'admin.stat-card' adalah nama view komponen Blade (resources/views/components/admin/stat-card.blade.php)
        Blade::component('admin.stat-card', 'admin.stat-card');

        // Anda bisa menambahkan bootstrapping service lain di sini
    }
}
