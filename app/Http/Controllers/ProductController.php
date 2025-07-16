<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private function checkAdmin()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Role tidak diizinkan.');
        }
    }

    public function index()
    {
        $products = Product::with(['category', 'supplier'])->latest()->paginate(10);
        return view('product.index', compact('products'));
    }

    public function create()
    {
        $this->checkAdmin();

        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('product.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        $this->checkAdmin();

        $request->validate([
            'nama'        => 'required|string|max:255',
            'kategori_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'satuan'      => 'required|string|max:50',
        ]);

        Product::create([
            'nama'        => $request->nama,
            'kategori_id' => $request->kategori_id,
            'supplier_id' => $request->supplier_id,
            'stock'       => 0,
            'satuan'      => $request->satuan,
        ]);

        return redirect()->route('product.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Product $product)
    {
        $this->checkAdmin();

        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('product.edit', compact('product', 'categories', 'suppliers'));
    }

    public function update(Request $request, Product $product)
    {
        $this->checkAdmin();

        $request->validate([
            'nama'        => 'required|string|max:255',
            'kategori_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'satuan'      => 'required|string|max:50',
        ]);

        $product->update($request->only('nama', 'kategori_id', 'supplier_id', 'satuan'));

        return redirect()->route('product.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Product $product)
    {
        $this->checkAdmin();

        $product->delete();
        return back()->with('success', 'Produk berhasil dihapus');
    }
}