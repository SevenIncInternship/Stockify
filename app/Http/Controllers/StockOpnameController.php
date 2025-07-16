<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockOpname;
use App\Models\Product;

class StockOpnameController extends Controller
{
    public function index()
    {
        $data = StockOpname::with('product')->latest()->paginate(10);
        return view('manajer.stock_opname.index', compact('data'));
    }

    public function create()
    {
        $products = Product::orderBy('nama')->get();
        return view('manajer.stock_opname.create', compact('products'));
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
        ]);

        return redirect()->route('manajer.stock_opname.index')
            ->with('success', 'Stock opname berhasil dicatat.');
    }

    public function show(StockOpname $stockOpname)
    {
        return view('manajer.stock_opname.show', compact('stockOpname'));
    }

    public function destroy(StockOpname $stockOpname)
    {
        $stockOpname->delete();
        return back()->with('success', 'Data stock opname dihapus.');
    }
}
