<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\Product;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barangKeluar = BarangKeluar::with('produk')->latest()->paginate(10);
        return view('barang_keluar.index', compact('barangKeluar'));
    }

    public function create()
    {
        $products = Product::all();
        return view('barang_keluar.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'produk_id' => 'required|exists:products,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ]);

        $validated['status_konfirmasi'] = 'pending';

        BarangKeluar::create($validated);

        return redirect()->route('barang_keluar.index')->with('success', 'Transaksi barang keluar berhasil ditambahkan.');
    }

    public function edit(BarangKeluar $barangKeluar)
    {
        if ($barangKeluar->status_konfirmasi !== 'pending') {
            return back()->withErrors(['error' => 'Transaksi sudah dikonfirmasi dan tidak bisa diedit.']);
        }

        $products = Product::all();
        return view('barang_keluar.edit', compact('barangKeluar', 'products'));
    }

    public function update(Request $request, BarangKeluar $barangKeluar)
    {
        if ($barangKeluar->status_konfirmasi !== 'pending') {
            return back()->withErrors(['error' => 'Transaksi sudah dikonfirmasi dan tidak bisa diperbarui.']);
        }

        $validated = $request->validate([
            'produk_id' => 'required|exists:products,id',
            'jumlah'    => 'required|integer|min:1',
            'tanggal'   => 'required|date',
        ]);

        $barangKeluar->update($validated);

        return redirect()->route('barang_keluar.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(BarangKeluar $barangKeluar)
    {
        if ($barangKeluar->status_konfirmasi === 'diterima') {
            $product = $barangKeluar->produk;
            $product->stock += $barangKeluar->jumlah;
            $product->save();
        }

        $barangKeluar->delete();

        return redirect()->route('barang_keluar.index')->with('success', 'Data barang keluar berhasil dihapus.');
    }
}
