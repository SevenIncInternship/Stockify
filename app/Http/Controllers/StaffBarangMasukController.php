<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\Product;

class StaffBarangMasukController extends Controller
{
    /**
     * Menampilkan semua data barang masuk yang masih pending untuk dikonfirmasi staff.
     */
    public function index()
    {
        $barangMasukPending = BarangMasuk::with('product')->where('status_konfirmasi', 'pending')->get();
        return view('staff.barang_masuk.index', compact('barangMasukPending'));
    }

    /**
     * Update status konfirmasi barang masuk oleh staff.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status_konfirmasi' => 'required|in:pending,diterima,ditolak',
        ]);

        $barangMasuk = BarangMasuk::findOrFail($id);
        $statusLama = $barangMasuk->status_konfirmasi;
        $jumlah = $barangMasuk->jumlah;

        // Perbarui status
        $barangMasuk->update([
            'status_konfirmasi' => $request->status_konfirmasi,
        ]);

        // Jika status sebelumnya bukan 'diterima' dan sekarang 'diterima', tambahkan stok
        if ($statusLama !== 'diterima' && $request->status_konfirmasi === 'diterima') {
            $produk = Product::find($barangMasuk->product_id);
            if ($produk) {
                $produk->increment('stock', $jumlah);
            }
        }

        return redirect()->back()->with('success', 'Status barang masuk berhasil diperbarui.');
    }
}
