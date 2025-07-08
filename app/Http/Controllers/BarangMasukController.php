<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barangMasuk = BarangMasuk::with('product')->latest()->paginate(10);
        return view('barang_masuk.index', compact('barangMasuk'));
    }

    public function create()
    {
        $products = Product::with('category')->get();
        $suppliers = Supplier::all();
        $categories = Category::all();
        return view('barang_masuk.create', compact('products', 'suppliers', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'required|string|in:kg,pcs,Lt',
            'tanggal' => 'required|date',
            'status_konfirmasi' => 'required|in:pending,diterima,ditolak',

            'product_id' => 'nullable|exists:products,id|required_without:produk_baru',
            'produk_baru' => 'nullable|string|max:255|required_without:product_id',

            'kategori_id' => 'nullable|exists:categories,id',
            'kategori_baru' => 'nullable|string|max:255',

            'supplier_id' => 'nullable|exists:suppliers,id|required_without:supplier_baru',
            'supplier_baru' => 'nullable|string|max:255|required_without:supplier_id',
        ]);

        // === SUPPLIER ===
        $supplierId = $request->supplier_id;
        if ($request->filled('supplier_baru')) {
            $supplier = Supplier::firstOrCreate(
                ['nama' => trim($request->supplier_baru)],
                ['alamat' => '-', 'telepon' => '-']
            );
            $supplierId = $supplier->id;
        }

        // === KATEGORI ===
        $kategoriId = $request->kategori_id;
        if ($request->filled('kategori_baru')) {
            $kategori = Category::firstOrCreate(
                ['nama' => trim($request->kategori_baru)]
            );
            $kategoriId = $kategori->id;
        }

        // === PRODUK ===
        $produk = null;
        $productId = $request->product_id;

        if ($request->filled('produk_baru')) {
            $namaProdukBaru = trim($request->produk_baru);

            if (!$namaProdukBaru) {
                return back()->withErrors(['produk_baru' => 'Nama produk tidak boleh kosong.'])->withInput();
            }

            if (!$kategoriId) {
                return back()->withErrors(['kategori_id' => 'Pilih kategori atau isi kategori baru untuk produk baru.'])->withInput();
            }

            $produk = new Product();
            $produk->fill([
                'nama' => $namaProdukBaru,
                'kategori_id' => $kategoriId,
                'supplier_id' => $supplierId,
                'stock' => 0,
                'satuan' => $request->satuan,
            ]);
            $produk->save();

            $productId = $produk->id;
        } else {
            $produk = Product::findOrFail($productId);

            if (!$produk->supplier_id && $supplierId) {
                $produk->supplier_id = $supplierId;
                $produk->save();
            }
        }

        if (!$productId || !$produk) {
            return back()->withErrors(['product_id' => 'Produk tidak valid atau gagal disimpan.'])->withInput();
        }

        // === SIMPAN BARANG MASUK ===
        $barangMasuk = BarangMasuk::create([
            'product_id' => $productId,
            'supplier_id' => $supplierId,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
            'tanggal' => $request->tanggal,
            'status_konfirmasi' => $request->status_konfirmasi,
        ]);

        $produk->increment('stock', $barangMasuk->jumlah);

        return redirect()->route('admin.barang_masuk.index')->with('success', 'Barang masuk berhasil ditambahkan.');
    }
}
