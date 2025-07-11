<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ManajerDashboardController;
use App\Http\Controllers\StaffDashboardController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\LaporanController;

use App\Http\Controllers\StaffBarangMasukController;
use App\Http\Controllers\StaffBarangKeluarController;

use App\Http\Controllers\Manajer\ManajerBarangMasukController;
use App\Http\Controllers\Manajer\ManajerBarangKeluarController;
use App\Http\Controllers\Manajer\ManajerProdukController;
use App\Http\Controllers\Manajer\ManajerSupplierController;
use App\Http\Controllers\Manajer\ManajerLaporanController;


// =================== HALAMAN UTAMA =====================
Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('redirect.role')
        : view('welcome');
})->name('welcome');

// =================== AUTENTIKASI =====================
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/lupa', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/lupa', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
});

// =================== LOGOUT =====================
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// =================== RUTE TERLINDUNGI (LOGIN) =====================
Route::middleware(['auth'])->group(function () {

    // === Redirect ke dashboard sesuai role ===
    Route::get('/redirect-role', function () {
        $user = Auth::user();

        return match ($user->role) {
            'admin'   => redirect()->route('admin.dashboard'),
            'manajer' => redirect()->route('manajer.dashboard'),
            'staff'   => redirect()->route('staff.dashboard'),
            default   => abort(403, 'Peran pengguna tidak dikenal.'),
        };
    })->name('redirect.role');

    // ================= ADMIN =================
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('products', ProductController::class)->names('product');
        Route::resource('barang_masuk', BarangMasukController::class)->names('barang_masuk');
        Route::resource('barang_keluar', BarangKeluarController::class)->names('barang_keluar');
        Route::resource('categories', CategoryController::class)->names('category');
        Route::resource('suppliers', SupplierController::class)->names('suppliers');

        Route::get('laporan/barang-masuk/pdf', [LaporanController::class, 'barangMasukPDF'])->name('laporan.barangMasuk.pdf');
    });

        // ================= MANAJER =================
    Route::middleware(['role:manajer'])->prefix('manajer')->name('manajer.')->group(function () {
        Route::get('/dashboard', [ManajerDashboardController::class, 'index'])->name('dashboard');

        //barangmasuk
        Route::resource('barang_masuk', ManajerBarangMasukController::class)->names('barang_masuk');
        //barangkeluar
        Route::resource('barang_keluar', ManajerBarangKeluarController::class)->names('barang_keluar');
        Route::prefix('manajer')->middleware(['auth', 'role:manajer'])->group(function () {
        Route::resource('barang_keluar', \App\Http\Controllers\Manajer\ManajerBarangKeluarController::class)->names('manajer.barang_keluar');});
        //produk
        Route::resource('produk', ManajerProdukController::class)->names('produk');
        //supplier
        Route::resource('supplier', ManajerSupplierController::class)->names('supplier');
        Route::get('laporan', [ManajerLaporanController::class, 'index'])->name('laporan.index');
    });


    // ================= STAFF =================
    Route::middleware(['role:staff'])->prefix('staff')->name('staff.')->group(function () {
        Route::get('/dashboard', [StaffDashboardController::class, 'index'])->name('dashboard');

        Route::get('barang_masuk/{id}/konfirmasi', [StaffBarangMasukController::class, 'konfirmasi'])->name('barangMasuk.konfirmasi');
        Route::put('barang_masuk/{id}/konfirmasi', [StaffBarangMasukController::class, 'update'])->name('barangMasuk.update_konfirmasi');

        Route::get('barang_keluar/{id}/konfirmasi', [StaffBarangKeluarController::class, 'konfirmasi'])->name('barangKeluar.konfirmasi');
        Route::put('barang_keluar/{id}/konfirmasi', [StaffBarangKeluarController::class, 'update'])->name('barangKeluar.update_konfirmasi');
    });

    Route::get('/redirect-role', function () {
    $user = Auth::user();
    return match ($user->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'manajer' => redirect()->route('manajer.dashboard'),
        'staff' => redirect()->route('staff.dashboard'),
        default => abort(403),
    };
    })->name('redirect.role');

});
