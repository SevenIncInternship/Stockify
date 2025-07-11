<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Tambahkan ini untuk menggunakan Auth facade

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    // Mengubah konstanta HOME untuk mengarahkan ke rute pengalihan peran
    public const HOME = '/redirect-role';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            // Middleware 'api' dan prefix 'api' untuk rute API
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Middleware 'web' untuk rute web standar
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // Tambahkan untuk manajer dan staff
            Route::middleware('web')
                ->group(base_path('routes/manajer.php'));

            Route::middleware('web')
                ->group(base_path('routes/staff.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            // Batasi 60 permintaan per menit per pengguna (berdasarkan ID pengguna atau IP)
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
