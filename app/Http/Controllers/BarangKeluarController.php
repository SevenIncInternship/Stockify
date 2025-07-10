<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\Product;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barangKeluar = BarangKeluar::with('product')->latest()->paginate(10);
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
            'product_id' => 'required|exists:products,id',
            'jumlah'     => 'required|integer|min:1',
            'satuan'     => 'required|string',
            'tanggal'    => 'required|date',
            'status_konfirmasi' => 'required|in:pending,diterima,ditolak',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        // Jika status langsung diterima, cek stok cukup atau tidak
        if ($validated['status_konfirmasi'] === 'diterima') {
            if ($product->stock < $validated['jumlah']) {
                return back()->withErrors(['jumlah' => 'Stok tidak mencukupi untuk barang keluar.'])->withInput();
            }

            // Kurangi stok
            $product->stock -= $validated['jumlah'];
            $product->save();
        }

        BarangKeluar::create($validated);

        return redirect()->route('admin.barang_keluar.index')->with('success', 'Transaksi barang keluar berhasil ditambahkan.');
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
            'product_id' => 'required|exists:products,id',
            'jumlah'     => 'required|integer|min:1',
            'satuan'     => 'required|string',
            'tanggal'    => 'required|date',
            'status_konfirmasi' => 'required|in:pending,diterima,ditolak',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        // Jika status berubah ke diterima, kurangi stok
        if ($validated['status_konfirmasi'] === 'diterima') {
            if ($product->stock < $validated['jumlah']) {
                return back()->withErrors(['jumlah' => 'Stok tidak mencukupi.'])->withInput();
            }

            $product->stock -= $validated['jumlah'];
            $product->save();
        }

        $barangKeluar->update($validated);

        return redirect()->route('admin.barang_keluar.index')->with('success', 'Transaksi barang keluar berhasil diperbarui.');
    }

    public function destroy(BarangKeluar $barangKeluar)
    {
        // Jika status diterima, kembalikan stok
        if ($barangKeluar->status_konfirmasi === 'diterima') {
            $product = $barangKeluar->product;
            if ($product) {
                $product->stok += $barangKeluar->jumlah;
                $product->save();
            }
        }

        $barangKeluar->delete();

        return redirect()->route('admin.barang_keluar.index')->with('success', 'Data barang keluar berhasil dihapus.');
    }
}