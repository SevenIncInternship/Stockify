<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangKeluar;
use App\Models\Product;

class StaffBarangKeluarController extends Controller
{
    /**
     * Menampilkan semua data barang keluar yang masih pending untuk dikonfirmasi staff.
     */
    public function index()
    {
        $barangKeluarPending = BarangKeluar::with('product')->where('status_konfirmasi', 'pending')->get();
        return view('staff.barang_keluar.index', compact('barangKeluarPending'));
    }

    /**
     * Update status konfirmasi barang keluar oleh staff.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status_konfirmasi' => 'required|in:pending,diterima,ditolak',
        ]);

        $barangKeluar = BarangKeluar::findOrFail($id);
        $statusLama = $barangKeluar->status_konfirmasi;
        $jumlah = $barangKeluar->jumlah;

        // Perbarui status
        $barangKeluar->update([
            'status_konfirmasi' => $request->status_konfirmasi,
        ]);

        
        if ($statusLama !== 'diterima' && $request->status_konfirmasi === 'diterima') {
            $produk = Product::find($barangKeluar->product_id);
            if ($produk) {
                $produk->decrement('stock', $jumlah);
            }
        }

        return redirect()->back()->with('success', 'Status barang keluar berhasil diperbarui.');
    }
}
