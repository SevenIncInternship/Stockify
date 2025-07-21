<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\Product;
use App\Models\StockOpname;

class ManajerDashboardController extends Controller
{
    public function index()
    {
        $barangMasuk = BarangMasuk::whereDate('created_at', today())
        ->where('status_konfirmasi','diterima')
        ->count();
        $barangKeluar = BarangKeluar::whereDate('created_at', today())
        ->where('status_konfirmasi','diterima')
        ->count();
        $totalProduk = Product::count();
        $stockOpname = StockOpname::count(); // Jika belum ada, bisa set default null

        // Data untuk grafik stok
        $produk = Product::select('nama', 'stock')->orderBy('nama')->take(10)->get();
        $labelsProduk = $produk->pluck('nama');
        $stokDataProduk = $produk->pluck('stock');

        return view('manajer.dashboard', [
            'barangMasuk' => $barangMasuk,
            'barangKeluar' => $barangKeluar,
            'totalProduk' => $totalProduk,
            'totalOpname' => $stockOpname,
            'labelsProduk' => $labelsProduk,
            'stokDataProduk' => $stokDataProduk,
        ]);
    }
}
