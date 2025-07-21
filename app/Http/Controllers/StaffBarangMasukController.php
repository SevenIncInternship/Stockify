<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk; // Pastikan model BarangMasuk diimpor dengan benar

class StaffBarangMasukController extends Controller
{
    /**
     * Mengkonfirmasi transaksi barang masuk.
     * Mengubah status barang masuk menjadi 'selesai' setelah dikonfirmasi.
     *
     * @param  int  $id ID transaksi BarangMasuk yang akan dikonfirmasi.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function konfirmasi($id)
    {
        // Mencari transaksi BarangMasuk berdasarkan ID atau menghentikan eksekusi jika tidak ditemukan
        $barang = BarangMasuk::findOrFail($id);

        // Mengubah status transaksi menjadi 'selesai'
        $barang->status_konfirmasi = 'diterima';
        $barang->save(); // Menyimpan perubahan ke database

        // Mengarahkan kembali ke dashboard staff dengan pesan sukses
        return redirect()->route('staff.dashboard')->with('success', 'Barang masuk berhasil dikonfirmasi.');
    }
}
