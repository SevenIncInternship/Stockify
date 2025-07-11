<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangKeluar;
use App\Models\Product;

class ManajerBarangKeluarController extends Controller
{
    public function index()
    {
        $barang_keluar = BarangKeluar::with('produk')->latest()->get();
        return view('manajer.barang_keluar.index', compact('barang_keluar'));
    }

    public function create()
    {
        $produk = \App\Models\Product::all();
        $supplier = \App\Models\Supplier::all(); // <--- ini penting
        return view('manajer.barang_keluar.create', compact('produk', 'supplier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'jumlah' => 'required|numeric|min:1',
            'satuan' => 'required|string|max:50',
            'tanggal' => 'required|date'
        ]);

        BarangKeluar::create([
            'product_id' => $request->product_id,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
            'tanggal' => $request->tanggal,
            'status_konfirmasi' => 'pending'
        ]);

        // Kurangi stok produk
        $produk = \App\Models\Product::find($request->product_id);
        $produk->stok -= $request->jumlah;
        $produk->save();

        return redirect()->route('manajer.barang_keluar.index')->with('success', 'Barang keluar berhasil ditambahkan.');
    }



    public function edit($id)
    {
        $barang_keluar = BarangKeluar::findOrFail($id);
        $produk = Product::all();
        return view('manajer.barang_keluar.edit', compact('barang_keluar', 'produk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'jumlah' => 'required|integer|min:1'
        ]);

        $barang_keluar = BarangKeluar::findOrFail($id);
        $barang_keluar->update([
            'product_id' => $request->product_id,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route('manajer.barang_keluar.index')->with('success', 'Barang keluar berhasil diupdate.');
    }

    public function destroy($id)
    {
        $barang_keluar = BarangKeluar::findOrFail($id);
        $barang_keluar->delete();

        return redirect()->route('manajer.barang_keluar.index')->with('success', 'Barang keluar berhasil dihapus.');
    }
}
