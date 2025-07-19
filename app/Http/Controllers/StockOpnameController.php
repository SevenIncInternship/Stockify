<?php

namespace App\Http\Controllers;

use App\Models\StockOpname;
use App\Models\Product;
use Illuminate\Http\Request;

class StockOpnameController extends Controller
{
    private function getPrefixByRole()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return 'admin';
        } elseif ($user->role === 'manajer') {
            return 'manajer';
        } elseif ($user->role === 'staff') {
            return 'staff';
        } else {
            abort(403, 'Role tidak diizinkan.');
        }
    }

    public function index()
    {
        $stockOpname = StockOpname::with('product')->latest()->paginate(10);
        return view('stock_opname.index', compact('stockOpname'));
    }

    public function create()
    {
        $products = Product::orderBy('nama')->get();
        $rolePrefix = $this->getPrefixByRole();

        return view('stock_opname.create', compact('products', 'rolePrefix'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'stok_fisik' => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $produk = Product::findOrFail($request->product_id);
        $stokSistem = $produk->stock;

        StockOpname::create([
            'product_id' => $produk->id,
            'stok_fisik' => $request->stok_fisik,
            'stok_sistem' => $stokSistem,
            'keterangan' => $request->keterangan,
            'user_id' => auth()->id(),
        ]);

        $prefix = $this->getPrefixByRole();

        return redirect()->route("{$prefix}.stock_opname.index")
            ->with('success', 'Stock opname berhasil dicatat.');
    }

    public function show($id)
    {
        $stockOpname = StockOpname::with('product')->findOrFail($id);
        return view('stock_opname.show', compact('stockOpname'));
    }

    public function destroy($id)
    {
        $stockOpname = StockOpname::findOrFail($id);

        if (auth()->user()->role !== 'manajer') {
            abort(403, 'Hanya manajer yang boleh menghapus data stock opname.');
        }

        $stockOpname->delete();

        $prefix = $this->getPrefixByRole();

        return redirect()->route("{$prefix}.stock_opname.index")
            ->with('success', 'Data stock opname berhasil dihapus.');
    }
}