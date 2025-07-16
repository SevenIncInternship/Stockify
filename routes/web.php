<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\AuthController; // Ini mungkin tidak lagi diperlukan jika semua auth dipindahkan ke LoginController/RegisterController
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController; // Tambahkan ini untuk LoginController

use App\Http\Controllers\StaffDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ManajerDashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\StaffBarangMasukController;
use App\Http\Controllers\StaffBarangKeluarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\StockOpnameController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sinilah Anda dapat mendaftarkan rute web untuk aplikasi Anda.
| Rute ini dimuat oleh RouteServiceProvider dalam grup yang
| berisi middleware "web". Buat sesuatu yang hebat!
|
*/

// =========================================================
// HALAMAN AWAL (Welcome)
// Jika pengguna sudah login, arahkan ke dashboard sesuai peran.
// Jika belum, tampilkan halaman welcome.
// =========================================================
Route::get('/', function () {
    // Jika pengguna sudah login, langsung arahkan ke dashboard sesuai role
    if (Auth::check()) {
        return redirect()->route('redirect.role');
    }

    // Jika belum login, tampilkan halaman welcome
    return view('welcome');
})->name('welcome');

// =========================================================
// AUTENTIKASI (Hanya untuk GUEST - Pengguna yang belum login)
// =========================================================
Route::middleware(['guest'])->group(function () {
    // Rute Login (menggunakan LoginController)
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Rute Register (menggunakan RegisterController standar Laravel)
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    // Rute Lupa Kata Sandi (menggunakan ForgotPasswordController)
    Route::get('/lupa', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/lupa', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
});

// =========================================================
// LOGOUT (Untuk pengguna yang sudah login)
// =========================================================
// Rute Logout (menggunakan LoginController)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// =========================================================
// RUTE YANG MEMBUTUHKAN AUTENTIKASI (AUTH)
// =========================================================
Route::middleware(['auth'])->group(function () {

    // Rute pengalihan setelah login berdasarkan peran pengguna.
    // Ini adalah tujuan 'HOME' yang didefinisikan di RouteServiceProvider.
    Route::get('/redirect-role', function () {
        $user = Auth::user(); // Pengguna dijamin ada karena middleware 'auth'

        // Mengarahkan pengguna ke dashboard yang sesuai berdasarkan perannya.
        return match ($user->role) {
            'admin'   => redirect()->route('admin.dashboard'),
            'manajer' => redirect()->route('manajer.dashboard'),
            'staff'   => redirect()->route('staff.dashboard'),
            // Jika peran tidak dikenal atau tidak memiliki rute dashboard spesifik,
            // kembalikan error 403 Forbidden.
            default   => abort(403, 'Peran pengguna tidak dikenal atau tidak memiliki akses dashboard.'),
        };
    })->name('redirect.role');


    // =========================================================
    // ADMIN ROUTES (prefix + middleware role:admin)
    // =========================================================
    Route::middleware('role:admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

            // Resource routes untuk manajemen data master
            Route::resource('/products', ProductController::class)->names([
                'index' => 'product.index',
                'create' => 'product.create',
                'store' => 'product.store',
                'show' => 'product.show',
                'edit' => 'product.edit', 
                'update' => 'product.update',
                'destroy' => 'product.destroy',
            ]);
            
            Route::resource('/barang_masuk', BarangMasukController::class)->names([
                'index' => 'barang_masuk.index',
                'create' => 'barang_masuk.create',
                'store' => 'barang_masuk.store',
                'show' => 'barang_masuk.show',
                'edit' => 'barang_masuk.edit',
                'update' => 'barang_masuk.update',
                'destroy' => 'barang_masuk.destroy',
                'konfirmasi'=>'barang_masuk.konfirmasi',
            ]);
            
            Route::resource('/barang_keluar', BarangKeluarController::class)->names([
                'index' => 'barang_keluar.index',
                'create' => 'barang_keluar.create',
                'store' => 'barang_keluar.store',
                'show' => 'barang_keluar.show',
                'edit' => 'barang_keluar.edit',
                'update' => 'barang_keluar.update',
                'destroy' => 'barang_keluar.destroy',
            ]);
            
            Route::resource('/categories', CategoryController::class)->names([
                'index' => 'category.index',
                'create' => 'category.create',
                'store' => 'category.store',
                'show' => 'category.show',
                'edit' => 'category.edit',
                'update' => 'category.update',
                'destroy' => 'category.destroy',
            ]);
            
            Route::resource('/suppliers', SupplierController::class)->names([
                'index' => 'suppliers.index',
                'create' => 'suppliers.create',
                'store' => 'suppliers.store',
                'show' => 'suppliers.show',
                'edit' => 'suppliers.edit',
                'update' => 'suppliers.update',
                'destroy' => 'suppliers.destroy',
            ]);

            Route::resource('/user', UserController::class)->names([
                'index' => 'users.index',
                'create' => 'users.create',
                'store' => 'users.store',
                'show' => 'users.show',
                'edit' => 'users.edit',
                'update' => 'users.update',
                'destroy' => 'users.destroy',
            ]);

            // Rute Laporan (khusus Admin)
            Route::get('/laporan/barang_masuk/pdf', [LaporanController::class, 'barangMasukPDF'])->name('laporan.barangMasuk.pdf');
            // Tambahkan rute laporan lain di sini jika diperlukan
        });

    // =========================================================
    // MANAJER ROUTES (prefix + middleware role:manajer)
    // =========================================================
    Route::middleware('role:manajer')
        ->prefix('manajer')
        ->name('manajer.')
        ->group(function () {
            Route::get('/dashboard', [ManajerDashboardController::class, 'index'])->name('dashboard');
           Route::resource('/products', ProductController::class)->names([
                'index' => 'product.index',
                'create' => 'product.create',
                'store' => 'product.store',
                'show' => 'product.show',
                'edit' => 'product.edit', 
                'update' => 'product.update',
                'destroy' => 'product.destroy',
            ]);
            
            Route::resource('/barang_masuk', BarangMasukController::class)->names([
                'index' => 'barang_masuk.index',
                'create' => 'barang_masuk.create',
                'store' => 'barang_masuk.store',
                'show' => 'barang_masuk.show',
                'edit' => 'barang_masuk.edit',
                'update' => 'barang_masuk.update',
                'destroy' => 'barang_masuk.destroy',
                'konfirmasi'=>'barang_masuk.konfirmasi',
            ]);
            
            Route::resource('/barang_keluar', BarangKeluarController::class)->names([
                'index' => 'barang_keluar.index',
                'create' => 'barang_keluar.create',
                'store' => 'barang_keluar.store',
                'show' => 'barang_keluar.show',
                'edit' => 'barang_keluar.edit',
                'update' => 'barang_keluar.update',
                'destroy' => 'barang_keluar.destroy',
            ]);

            Route::resource('/stock_opname', StockOpnameController::class)->names([
                'index' => 'stock_opname.index',
                'create' => 'stock_opname.create',
                'store' => 'stock_opname.store',
                'show' => 'stock_opname.show',
                'edit' => 'stock_opname.edit',
                'update' => 'stock_opname.update',
                'destroy' => 'stock_opname.destroy',
            ]);

            Route::get('/dashboard/export/pdf', [\App\Http\Controllers\ManajerExportController::class, 'exportDashboard'])
            ->name('dashboard_export_pdf');

        });

    // =========================================================
    // STAFF ROUTES (prefix + middleware role:staff)
    // =========================================================
    Route::middleware('role:staff')
        ->prefix('staff')
        ->name('staff.')
        ->group(function () {
            Route::get('/dashboard', [StaffDashboardController::class, 'index'])->name('dashboard');

            // Barang Masuk konfirmasi
            Route::get('/barang_masuk/{id}/konfirmasi', [StaffBarangMasukController::class, 'konfirmasi'])->name('barangMasuk.konfirmasi');
            Route::put('/barang_masuk/{id}/konfirmasi', [StaffBarangMasukController::class, 'update'])->name('barangMasuk.update_konfirmasi');

            // Barang Keluar konfirmasi
            Route::get('/barang_keluar/{id}/konfirmasi', [StaffBarangKeluarController::class, 'konfirmasi'])->name('barangKeluar.konfirmasi');
            Route::put('/barang_keluar/{id}/konfirmasi', [StaffBarangKeluarController::class, 'update'])->name('barangKeluar.update_konfirmasi');
        });

    // Rute tambahan non-role dapat diletakkan di sini, di dalam grup 'auth'
    // Contoh: Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');
});
