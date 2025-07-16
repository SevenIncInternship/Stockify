<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::latest()->get();
        return view('admin.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('admin.suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'phone'   => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
        ]);

        Supplier::create($request->all());
        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier berhasil ditambahkan');
    }

    public function edit(Supplier $supplier)
    {
        return view('admin.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'phone'   => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
        ]);

        $supplier->update($request->all());
        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier berhasil diperbarui');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return back()->with('success', 'Supplier berhasil dihapus');
    }
}