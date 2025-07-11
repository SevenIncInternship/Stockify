<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\Product;
use App\Models\Supplier;

class ManajerBarangMasukController extends Controller
{
    public function index()
    {
        $barang_masuk = BarangMasuk::with(['produk', 'supplier'])->latest()->get();
        return view('manajer.barang_masuk.index', compact('barang_masuk'));
    }

    public function create()
    {
        $produk = Product::all();
        $supplier = Supplier::all();
        return view('manajer.barang_masuk.create', compact('produk', 'supplier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'jumlah' => 'required|numeric|min:1',
            'satuan' => 'required|string|max:50',
            'tanggal' => 'required|date',
        ]);

        BarangMasuk::create($request->all());

        // Tambahkan stok ke produk
        $produk = Product::find($request->product_id);
        $produk->stock += $request->jumlah;
        $produk->save();

        return redirect()->route('manajer.barang_masuk.index')->with('success', 'Barang masuk berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $barang_masuk = BarangMasuk::findOrFail($id);
        $produk = Product::all();
        $supplier = Supplier::all();
        return view('manajer.barang_masuk.edit', compact('barang_masuk', 'produk', 'supplier'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'jumlah' => 'required|numeric|min:1',
            'satuan' => 'required|string|max:50',
            'tanggal' => 'required|date',
        ]);

        $barang_masuk = BarangMasuk::findOrFail($id);
        $barang_masuk->update([
            'product_id' => $request->product_id,
            'supplier_id' => $request->supplier_id,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('manajer.barang_masuk.index')->with('success', 'Barang masuk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $barang_masuk = BarangMasuk::findOrFail($id);
        $barang_masuk->delete();

        return redirect()->route('manajer.barang_masuk.index')->with('success', 'Barang masuk berhasil dihapus.');
    }
}
