<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;

class ManajerProdukController extends Controller
{
    public function index() {
        $produk = Product::with(['category', 'supplier'])->get();
        return view('manajer.produk.index', compact('produk'));
    }

    public function create()
    {
        $kategori = Category::all();
        $suppliers = Supplier::all();
        return view('manajer.produk.create', compact('kategori', 'suppliers'));
    }

    public function store(Request $request)
    {
        Product::create($request->all());
        return redirect()->route('manajer.produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produk = Product::findOrFail($id);
        $kategori = Category::all();
        $suppliers = Supplier::all();
        return view('manajer.produk.edit', compact('produk', 'kategori', 'suppliers'));
    }

    public function update(Request $request, $id)
    {
        $produk = Product::findOrFail($id);
        $produk->update($request->all());
        return redirect()->route('manajer.produk.index')->with('success', 'Produk berhasil diupdate.');
    }

    public function destroy($id)
    {
        $produk = Product::findOrFail($id);
        $produk->delete();
        return redirect()->route('manajer.produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
