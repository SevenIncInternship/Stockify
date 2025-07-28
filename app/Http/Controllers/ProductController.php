<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    private function checkRole($roles = ['admin'])
    {
        if (!in_array(auth()->user()->role, $roles)) {
            abort(403, 'Role tidak diizinkan.');
        }
    }

    private function rolePrefix()
    {
        return auth()->user()->role === 'manajer' ? 'manajer' : 'admin';
    }

    public function index()
    {
        $this->checkRole(['admin', 'manajer']);

        $products = Product::with(['category', 'supplier'])->latest()->paginate(10);
        return view('product.index', compact('products'));
    }

    public function create()
    {
        $this->checkRole(['admin']);

        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('product.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        $this->checkRole(['admin']);

        $request->validate([
            'nama'          => 'required|string|max:255',
            'kategori_id'   => 'required|exists:categories,id',
            'supplier_id'   => 'required|exists:suppliers,id',
            'satuan'        => 'required|string|max:50',
            'harga_beli'    => 'nullable|numeric|min:0',
            'harga_jual'    => 'nullable|numeric|min:0',
            'minimal_stok'  => 'nullable|integer|min:0',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('image') ? $request->file('image')->store('products', 'public') : null;

        $sku = 'SKU-' . strtoupper(Str::random(8));

        Product::create([
            'nama'          => $request->nama,
            'SKU'           => $sku,
            'kategori_id'   => $request->kategori_id,
            'supplier_id'   => $request->supplier_id,
            'stock'         => 0, 
            'satuan'        => $request->satuan,
            'harga_beli'    => $request->harga_beli ?? 0,
            'harga_jual'    => $request->harga_jual ?? 0,
            'minimal_stok'  => $request->minimal_stok ?? 0,
            'image'         => $path,
        ]);

        return redirect()->route($this->rolePrefix() . '.product.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Product $product)
    {
        $this->checkRole(['admin', 'manajer']);

        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('product.edit', compact('product', 'categories', 'suppliers'));
    }

    public function update(Request $request, Product $product)
    {
        $this->checkRole(['admin', 'manajer']);

        $request->validate([
            'nama'          => 'required|string|max:255',
            'kategori_id'   => 'required|exists:categories,id',
            'supplier_id'   => 'required|exists:suppliers,id',
            'satuan'        => 'required|string|max:50',
            'harga_beli'    => 'nullable|numeric|min:0',
            'harga_jual'    => 'nullable|numeric|min:0',
            'minimal_stok'  => 'nullable|integer|min:0',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only([
            'nama',
            'kategori_id',
            'supplier_id',
            'satuan',
            'harga_beli',
            'harga_jual',
            'minimal_stok',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route($this->rolePrefix() . '.product.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Product $product)
    {
        $this->checkRole(['admin', 'manajer']);

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route($this->rolePrefix() . '.product.index')->with('success', 'Produk berhasil dihapus');
    }

    public function generateMissingSku()
    {
        $products = Product::whereNull('sku')->get();
        $jumlah = 0;

        foreach ($products as $product) {
            $product->sku = 'SKU-' . strtoupper(Str::random(8));
            $product->save();
            $jumlah++;
        }

        return redirect()->back()->with('success', "$jumlah SKU berhasil digenerate.");
    }
}