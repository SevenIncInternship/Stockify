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
        // Ringkasan Data
        $totalProduk    = Product::count();
        $totalMasuk     = BarangMasuk::count();
        $totalKeluar    = BarangKeluar::count();
        $totalUser      = User::count();
        $totalKategori  = Category::count();
        $totalSupplier  = Supplier::count();

        // Pengguna Terbaru (5 terakhir)
        $penggunaTerbaru = User::latest()->take(5)->get();

        // Grafik Stok Produk
        $labelsProduk   = Product::pluck('nama')->toArray();
        $stokDataProduk = Product::pluck('stock')->toArray();

        // Data Harian untuk 7 hari terakhir
        $startDate = Carbon::now()->subDays(6)->startOfDay();

       // Gunakan DB::raw untuk grouping
        $barangMasukHarian = BarangMasuk::selectRaw('DATE(created_at) as tanggal, SUM(jumlah) as total')
            ->where('created_at', '>=', '2025-06-29 00:00:00')
            ->groupByRaw('DATE(created_at)')
            ->orderBy('tanggal', 'asc')
            ->get();

        // Gunakan DB::raw untuk grouping
        $barangKeluarHarian = BarangKeluar::selectRaw('DATE(created_at) as tanggal, SUM(jumlah) as total')
            ->where('created_at', '>=', '2025-06-29 00:00:00')
            ->groupByRaw('DATE(created_at)')
            ->orderBy('tanggal', 'asc')
            ->get();

        $labelsHarian     = [];
        $dataMasukHarian  = [];
        $dataKeluarHarian = [];

        for ($i = 0; $i < 7; $i++) {
            $tanggal = Carbon::now()->subDays(6 - $i)->format('Y-m-d');
            $labelsHarian[]     = $tanggal;
            $dataMasukHarian[]  = $barangMasukHarian[$tanggal]->total ?? 0;
            $dataKeluarHarian[] = $barangKeluarHarian[$tanggal]->total ?? 0;
        }

        return view('admin.dashboard', compact(
            'totalProduk',
            'totalMasuk',
            'totalKeluar',
            'totalUser',
            'totalKategori',
            'totalSupplier',
            'penggunaTerbaru',
            'labelsProduk',
            'stokDataProduk',
            'labelsHarian',
            'dataMasukHarian',
            'dataKeluarHarian'
        ));
    }
}
