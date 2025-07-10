<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\Category;
use App\Models\Supplier;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
{
    $totalProduk    = Product::count();
    $totalMasuk     = BarangMasuk::count();
    $totalKeluar    = BarangKeluar::count();
    $totalUser      = User::count();
    $totalKategori  = Category::count();
    $totalSupplier  = Supplier::count();

    $labelsProduk   = Product::pluck('nama')->toArray();
    $stokDataProduk = Product::pluck('stock')->toArray();

    $labelsHarian = [];
    $dataMasukHarian = [];
    $dataKeluarHarian = [];

    for ($i = 0; $i < 7; $i++) {
        $tanggalCarbon = \Carbon\Carbon::now()->subDays(6 - $i);
        $tanggal = $tanggalCarbon->format('Y-m-d');
        $labelTampil = $tanggalCarbon->format('d M'); // contoh: 10 Jul
        $labelsHarian[] = $labelTampil;

        $dataMasuk = \App\Models\BarangMasuk::whereDate('created_at', $tanggal)->sum('jumlah');
        $dataKeluar = \App\Models\BarangKeluar::whereDate('created_at', $tanggal)->sum('jumlah');

        $dataMasukHarian[] = $dataMasuk;
        $dataKeluarHarian[] = $dataKeluar;
    }

    return view('admin.dashboard', compact(
        'totalProduk',
        'totalMasuk',
        'totalKeluar',
        'totalUser',
        'totalKategori',
        'totalSupplier',
        'labelsProduk',
        'stokDataProduk',
        'labelsHarian',
        'dataMasukHarian',
        'dataKeluarHarian'
    ));
}
}