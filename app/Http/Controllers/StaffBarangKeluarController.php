<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangKeluar; // Pastikan model BarangKeluar diimpor dengan benar

class StaffBarangKeluarController extends Controller
{
    /**
     * Mengkonfirmasi transaksi barang keluar.
     * Mengubah status barang keluar menjadi 'selesai' setelah dikonfirmasi.
     *
     * @param  int  $id ID transaksi BarangKeluar yang akan dikonfirmasi.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function konfirmasi($id)
    {
        // Mencari transaksi BarangKeluar berdasarkan ID atau menghentikan eksekusi jika tidak ditemukan
        $barang = BarangKeluar::findOrFail($id);

        // Mengubah status transaksi menjadi 'selesai'
        $barang->status = 'selesai';
        $barang->save(); // Menyimpan perubahan ke database

        // Mengarahkan kembali ke dashboard staff dengan pesan sukses
        return redirect()->route('staff.dashboard')->with('success', 'Barang keluar berhasil dikonfirmasi.');
    }
}
