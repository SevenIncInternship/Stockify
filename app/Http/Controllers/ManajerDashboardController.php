<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\Product;

class ManajerDashboardController extends Controller
{
    public function index()
    {
        // Ambil data yang relevan untuk manajer
        $barangMasukHariIni = BarangMasuk::whereDate('created_at', today())->count();
        $barangKeluarHariIni = BarangKeluar::whereDate('created_at', today())->count();
        $totalProduk = Product::count();

        return view('manajer.dashboard', [
            'masukHariIni' => $barangMasukHariIni,
            'keluarHariIni' => $barangKeluarHariIni,
            'totalProduk' => $totalProduk,
        ]);
    }
}
