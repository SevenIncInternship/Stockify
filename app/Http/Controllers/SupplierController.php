<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Tampilkan daftar semua supplier.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('admin.suppliers.index', compact('suppliers'));
    }

    /**
     * Tampilkan form tambah supplier.
     */
    public function create()
    {
        return view('admin.suppliers.create');
    }

    /**
     * Simpan data supplier baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:20',
        ]);

        Supplier::create($request->only(['nama', 'alamat', 'telepon']));

        return redirect()->route('admin.supplier.index')->with('success', 'Supplier berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit supplier.
     */
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('admin.suppliers.edit', compact('supplier'));
    }

    /**
     * Update data supplier.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:20',
        ]);

        $supplier->update($request->only(['nama', 'alamat', 'telepon']));

        return redirect()->route('admin.supplier.index')->with('success', 'Supplier berhasil diperbarui.');
    }

    /**
     * Hapus data supplier.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('admin.supplier.index')->with('success', 'Supplier berhasil dihapus.');
    }
}
