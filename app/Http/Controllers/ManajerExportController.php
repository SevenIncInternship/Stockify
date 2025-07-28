<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\StockOpname;
use Barryvdh\DomPDF\Facade\Pdf;


class ManajerExportController extends Controller
{
    public function exportDashboard()
    {
        $totalProduk = Product::count();
        $barangMasuk = BarangMasuk::count();
        $barangKeluar = BarangKeluar::count();
        $totalOpname = StockOpname::count();

        $pdf = PDF::loadView('manajer.laporan_dashboard_pdf', [
            'totalProduk' => $totalProduk,
            'barangMasuk' => $barangMasuk,
            'barangKeluar' => $barangKeluar,
            'totalOpname' => $totalOpname,
        ]);

        return $pdf->download('laporan_dashboard.pdf');
    }

    public function index()
    {
        $totalProduk = Product::count();
        $barangMasuk = BarangMasuk::count();
        $barangKeluar = BarangKeluar::count();
        $totalOpname = StockOpname::count();

        // Tambahan buat chart
        $produkList = Product::all();
        $labelsProduk = $produkList->pluck('nama')->toArray();
        $stokDataProduk = $produkList->pluck('stok')->toArray();

        return view('manajer.dashboard', compact(
            'totalProduk',
            'barangMasuk',
            'barangKeluar',
            'totalOpname',
            'labelsProduk',
            'stokDataProduk'
        ));
    }


}