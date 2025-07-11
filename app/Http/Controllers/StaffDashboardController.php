<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;

class StaffDashboardController extends Controller
{
    /**
     * Menampilkan dashboard khusus untuk Staff Gudang.
     * Mengambil data barang masuk dan keluar yang masih pending.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil data dengan relasi produk
        $barangMasukPending = BarangMasuk::with('product')->where('status_konfirmasi', 'pending')->get();
        $barangKeluarPending = \DB::table('barang_keluars')->where('status_konfirmasi', 'pending')->get();


        return view('staff.dashboard', [
            'barangMasukPending' => $barangMasukPending,
            'barangKeluarPending' => $barangKeluarPending,
        ]);
    }
}
