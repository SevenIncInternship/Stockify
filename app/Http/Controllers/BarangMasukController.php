<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index()
    {
        $items = BarangMasuk::all();
        return view('admin.barang_masuk.index', compact('items'));
    }

    public function create()
    {
        return view('admin.barang_masuk.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required',
            'jumlah' => 'required|integer',
            'satuan' => 'required',
        ]);

        $validated['status'] = 'pending';
        BarangMasuk::create($validated);
        return redirect()->route('barang-masuk.index')->with('success', 'Barang masuk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = BarangMasuk::findOrFail($id);
        return view('admin.barang_masuk.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = BarangMasuk::findOrFail($id);
        $validated = $request->validate([
            'nama_barang' => 'required',
            'jumlah' => 'required|integer',
            'satuan' => 'required',
            'status' => 'required',
        ]);

        $item->update($validated);
        return redirect()->route('barang-masuk.index')->with('success', 'Barang masuk diperbarui.');
    }

    public function destroy($id)
    {
        $item = BarangMasuk::findOrFail($id);
        $item->delete();
        return redirect()->route('barang-masuk.index')->with('success', 'Barang masuk dihapus.');
    }
}