<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\StockOpname;
use PDF;

class ManajerExportController extends Controller
{
    public function exportDashboard()
    {
        $totalProduk = Product::count();
        $barangMasuk = BarangMasuk::count();
        $barangKeluar = BarangKeluar::count();
        $totalOpname = StockOpname::count();

        $pdf = PDF::loadView('laporan_dashboard_pdf', [
            'totalProduk' => $totalProduk,
            'barangMasuk' => $barangMasuk,
            'barangKeluar' => $barangKeluar,
            'totalOpname' => $totalOpname,
        ]);

        return $pdf->download('laporan_dashboard.pdf');
    }
}