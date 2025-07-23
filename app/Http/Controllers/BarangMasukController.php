<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    private function getPrefixByRole()
    {
        $user = auth()->user();
        return match($user->role) {
            'admin' => 'admin',
            'manajer' => 'manajer',
            default => abort(403, 'Role tidak diizinkan.')
        };
    }

    private function generateSKU()
    {
        return 'SKU-' . strtoupper(uniqid());
    }

    public function index()
    {
        $barangMasuk = BarangMasuk::with('product')->latest()->paginate(10);
        $prefix = $this->getPrefixByRole();
        return view("barang_masuk.index", compact('barangMasuk'));
    }

    public function create()
    {
        $products = Product::with('category')->get();
        $suppliers = Supplier::all();
        $categories = Category::all();
        $defaultTanggal = now()->format('Y-m-d\TH:i');
        $rolePrefix = $this->getPrefixByRole();
        return view("barang_masuk.create", compact('products', 'suppliers', 'categories', 'defaultTanggal', 'rolePrefix'));
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

    // Supplier
    $supplierId = $request->supplier_id;
    if ($request->filled('supplier_baru')) {
        $supplier = Supplier::firstOrCreate(
            ['nama' => trim($request->supplier_baru)],
            ['alamat' => '-', 'telepon' => '-']
        );
        $supplierId = $supplier->id;
    }

    // Kategori
    $kategoriId = $request->kategori_id;
    if ($request->filled('kategori_baru')) {
        $kategori = Category::firstOrCreate(['nama' => trim($request->kategori_baru)]);
        $kategoriId = $kategori->id;
    }

    // Produk
    $productId = $request->product_id;
    if ($request->filled('produk_baru')) {
        $produk = Product::create([
            'nama' => trim($request->produk_baru),
            'kategori_id' => $kategoriId,
            'supplier_id' => $supplierId,
            'stock' => 0,
            'satuan' => $request->satuan,
            'SKU' => $this->generateSKU(),
        ]);
        $productId = $produk->id;
    } else {
        $produk = Product::findOrFail($productId);
        if (!$produk->supplier_id && $supplierId) {
            $produk->supplier_id = $supplierId;
            if (empty($produk->SKU)) {
                $produk->SKU = $this->generateSKU();
            }
            $produk->save();
        }
    }

    // Simpan barang masuk
    $barangMasuk = BarangMasuk::create([
        'product_id' => $productId,
        'supplier_id' => $supplierId,
        'jumlah' => $request->jumlah,
        'satuan' => $request->satuan,
        'tanggal' => $request->tanggal,
        'status_konfirmasi' => strtolower($request->status_konfirmasi),
    ]);

    // Tambah stok jika diterima
    if ($barangMasuk->status_konfirmasi === 'diterima') {
        $produk = Product::find($barangMasuk->product_id);
        if ($produk) {
            $produk->increment('stock', $barangMasuk->jumlah);
        }
    }

    $prefix = $this->getPrefixByRole();
    return redirect()->route("{$prefix}.barang_masuk.index")->with('success', 'Barang masuk berhasil ditambahkan.');
}


    public function edit($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        $products = Product::with('category')->get();
        $suppliers = Supplier::all();
        $categories = Category::all();
        $tanggalValue = now()->format('Y-m-d\TH:i');
        $prefix = $this->getPrefixByRole();
        return view("barang_masuk.edit", compact('barangMasuk', 'products', 'suppliers', 'categories', 'tanggalValue'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'supplier_id' => 'required|exists:suppliers,id',
        'jumlah' => 'required|integer|min:1',
        'satuan' => 'required|string|in:kg,pcs,Lt',
        'tanggal' => 'required|date',
        'status_konfirmasi' => 'required|in:pending,diterima,ditolak',
    ]);

    $barangMasuk = BarangMasuk::findOrFail($id);

    $statusLama = strtolower($barangMasuk->status_konfirmasi);
    $statusBaru = strtolower($request->status_konfirmasi);
    $jumlahLama = $barangMasuk->jumlah;
    $jumlahBaru = $request->jumlah;

    $produk = Product::findOrFail($request->product_id);

    // Pengaturan stok
    if ($statusLama === 'diterima' && $statusBaru !== 'diterima') {
        $produk->decrement('stock', $jumlahLama);
    } elseif ($statusLama !== 'diterima' && $statusBaru === 'diterima') {
        $produk->increment('stock', $jumlahBaru);
    } elseif ($statusLama === 'diterima' && $statusBaru === 'diterima' && $jumlahLama !== $jumlahBaru) {
        $selisih = $jumlahBaru - $jumlahLama;
        $produk->increment('stock', $selisih); 
    }

    // Update data barang masuk
    $barangMasuk->update([
        'product_id' => $request->product_id,
        'supplier_id' => $request->supplier_id,
        'jumlah' => $jumlahBaru,
        'satuan' => $request->satuan,
        'tanggal' => $request->tanggal,
        'status_konfirmasi' => $statusBaru,
    ]);

    $prefix = $this->getPrefixByRole();
    return redirect()->route("{$prefix}.barang_masuk.index")->with('success', 'Barang masuk berhasil diperbarui.');
}

    public function destroy(BarangMasuk $barangMasuk)
    {
        $barangMasuk->delete();
        $prefix = $this->getPrefixByRole();
        return redirect()->route("{$prefix}.barang_masuk.index")
            ->with('success', 'Data barang masuk berhasil dihapus.');
    }
}
