<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    /**
     * Laporan Stok Barang - PDF
     */
    public function stokPDF()
    {
        // Ambil data produk dengan stok
        $data = Product::with('category')->get();

        // Menggunakan view untuk render HTML ke PDF
        $pdf = Pdf::loadView('admin.laporan.stok_pdf', compact('data'));

        // Mengunduh PDF
        return $pdf->download('laporan_stok.pdf');
    }

    /**
     * Laporan Stok Barang - Tampilan
     */
    public function stok()
    {
        $products = Product::with('category')->get();
        return view('admin.laporan.stok', compact('products'));
    }

    /**
     * Laporan Barang Masuk - PDF
     */
    public function barangMasukPDF()
    {
        // Ambil data barang masuk
        $data = BarangMasuk::with('produk', 'supplier')->get();

        // Menggunakan view untuk render HTML ke PDF
        $pdf = Pdf::loadView('admin.laporan.barang_masuk_pdf', compact('data'));

        // Mengunduh PDF
        return $pdf->download('laporan_barang_masuk.pdf');
    }

    /**
     * Laporan Barang Masuk - Tampilan
     */
    public function barangMasuk()
    {
        $barangMasuk = BarangMasuk::with('produk', 'supplier')->get();
        return view('admin.laporan.barang_masuk', compact('barangMasuk'));
    }

    /**
     * Laporan Barang Keluar - PDF
     */
    public function barangKeluarPDF()
    {
        // Ambil data barang keluar
        $data = BarangKeluar::with('product', 'supplier')->get();

        // Menggunakan view untuk render HTML ke PDF
        $pdf = Pdf::loadView('admin.laporan.barang_keluar_pdf', compact('data'));

        // Mengunduh PDF
        return $pdf->download('laporan_barang_keluar.pdf');
    }

    /**
     * Laporan Barang Keluar - Tampilan
     */
    public function barangKeluar()
    {
        $barangKeluar = BarangKeluar::with('product', 'supplier')->get();
        return view('admin.laporan.barang_keluar', compact('barangKeluar'));
    }

    /**
     * Laporan Aktivitas Pengguna - PDF
     */
    public function aktivitasPenggunaPDF()
    {
        // Ambil data pengguna
        $data = User::all();

        // Menggunakan view untuk render HTML ke PDF
        $pdf = Pdf::loadView('admin.laporan.aktivitas_pengguna_pdf', compact('data'));

        // Mengunduh PDF
        return $pdf->download('laporan_aktivitas_pengguna.pdf');
    }

    /**
     * Laporan Aktivitas Pengguna - Tampilan
     */
    public function aktivitasPengguna()
    {
        $users = User::all();
        return view('admin.laporan.aktivitas_pengguna', compact('users'));
    }
}
