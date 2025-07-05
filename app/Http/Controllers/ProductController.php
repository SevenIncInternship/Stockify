<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category; // Tambahkan ini untuk mengimpor model Category
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar semua produk.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Menampilkan form untuk membuat produk baru.
     * Juga mengambil semua kategori untuk dropdown.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all(); // Mengambil semua kategori
        return view('admin.product.create', compact('categories')); // Mengirim kategori ke view
    }

    /**
     * Menyimpan produk baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:255', // Jika 'kategori' adalah nama kategori (string)
            // Atau 'category_id' => 'required|exists:categories,id', jika menggunakan foreign key
            'stok' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50',
        ]);

        Product::create($validated);
        return redirect()->route('product.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit produk yang sudah ada.
     *
     * @param  int  $id ID produk
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all(); // Ambil juga kategori untuk form edit
        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Memperbarui produk yang sudah ada di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id ID produk
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:255', // Jika 'kategori' adalah nama kategori (string)
            // Atau 'category_id' => 'required|exists:categories,id', jika menggunakan foreign key
            'stok' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50',
        ]);

        $product->update($validated);
        return redirect()->route('product.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Menghapus produk dari database.
     *
     * @param  int  $id ID produk
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Produk berhasil dihapus.');
    }
}
