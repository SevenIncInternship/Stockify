<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\BarangMasuk; // Pastikan model ini ada dan diimpor
use App\Models\BarangKeluar; // Pastikan model ini ada dan diimpor

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
        // Mengambil semua transaksi barang masuk yang berstatus 'pending'
        $barangMasukPending = BarangMasuk::with('product')->where('status_konfirmasi', 'pending')->get();

        // Mengambil semua transaksi barang keluar yang berstatus 'pending'
        $barangKeluarPending = BarangKeluar::with('product')->where('status_konfirmasi', 'pending')->get();

        // Mengembalikan view 'staff.dashboard' dengan data yang telah diambil
        return view('staff.dashboard', [
            'barangMasukPending' => $barangMasukPending,
            'barangKeluarPending' => $barangKeluarPending,
        ]);
    }
}
