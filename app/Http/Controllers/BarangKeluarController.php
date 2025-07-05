<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    /**
     * Tampilkan semua data barang keluar.
     */
    public function index()
    {
        $items = BarangKeluar::latest()->get();
        return view('admin.barang_keluar.index', compact('items'));
    }

    /**
     * Tampilkan form untuk tambah barang keluar.
     */
    public function create()
    {
        return view('admin.barang_keluar.create');
    }

    /**
     * Simpan data baru barang keluar.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah'      => 'required|integer|min:1',
            'satuan'      => 'required|string|max:50',
        ]);

        $validated['status'] = 'pending';

        BarangKeluar::create($validated);

        return redirect()->route('admin.barang-keluar.index')
                         ->with('success', 'Barang keluar berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit barang keluar.
     */
    public function edit($id)
    {
        $item = BarangKeluar::findOrFail($id);
        return view('admin.barang_keluar.edit', compact('item'));
    }

    /**
     * Proses update data barang keluar.
     */
    public function update(Request $request, $id)
    {
        $item = BarangKeluar::findOrFail($id);

        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah'      => 'required|integer|min:1',
            'satuan'      => 'required|string|max:50',
            'status'      => 'required|in:pending,selesai',
        ]);

        $item->update($validated);

        return redirect()->route('admin.barang-keluar.index')
                         ->with('success', 'Barang keluar berhasil diperbarui.');
    }

    /**
     * Hapus data barang keluar.
     */
    public function destroy($id)
    {
        $item = BarangKeluar::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.barang-keluar.index')
                         ->with('success', 'Barang keluar berhasil dihapus.');
    }
}
