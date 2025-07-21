<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\Product;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    private function getPrefixByRole()
    {
        $user = auth()->user();
        return match ($user->role) {
            'admin' => 'admin',
            'manajer' => 'manajer',
            default => abort(403, 'Role tidak diizinkan.')
        };
    }

    private function authorizeRole(array $allowedRoles)
    {
        $role = auth()->user()->role;
        if (!in_array($role, $allowedRoles)) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
    }

    public function index()
    {
        $barangKeluar = BarangKeluar::with('product')->latest()->paginate(10);
        $prefix = $this->getPrefixByRole();

        return view('barang_keluar.index', compact('barangKeluar'));
    }

    public function create(Request $request)
    {
        $this->authorizeRole(['admin', 'manajer', 'staff']);
        $products = Product::all();
        $rolePrefix = $this->getPrefixByRole();

        return view('barang_keluar.create', compact('products', 'rolePrefix'));
    }

    public function store(Request $request)
    {
        $this->authorizeRole(['admin', 'manajer', 'staff']);

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'required|string',
            'tanggal' => 'required|date',
            'status_konfirmasi' => 'nullable|in:pending,diterima,ditolak',
        ]);

        $userRole = $request->user()->role;

        // Tentukan status_konfirmasi berdasarkan role
        if ($userRole === 'staff') {
            $validated['status_konfirmasi'] = 'pending';
        } elseif ($userRole === 'manajer') {
            $validated['status_konfirmasi'] = $validated['status_konfirmasi'] ?? 'pending';
        } elseif ($userRole === 'admin') {
            $validated['status_konfirmasi'] = $validated['status_konfirmasi'] ?? 'pending';
        }

        $product = Product::findOrFail($validated['product_id']);

        // Jika diterima, kurangi stok
        if ($validated['status_konfirmasi'] === 'diterima') {
            if ($product->stock < $validated['jumlah']) {
                return back()->withErrors(['jumlah' => 'Stok tidak mencukupi.'])->withInput();
            }
            $product->stock -= $validated['jumlah'];
            $product->save();
        }

        BarangKeluar::create($validated);

        $prefix = $this->getPrefixByRole();
        return redirect()->route("{$prefix}.barang_keluar.index")->with('success', 'Barang keluar berhasil ditambahkan.');
    }

    public function edit(Request $request, BarangKeluar $barangKeluar)
    {
        $this->authorizeRole(['admin', 'manajer']);

        if ($barangKeluar->status_konfirmasi !== 'pending') {
            return back()->withErrors(['error' => 'Transaksi sudah dikonfirmasi dan tidak bisa diedit.']);
        }

        $products = Product::all();
        return view('barang_keluar.edit', compact('barangKeluar', 'products'));
    }

    public function update(Request $request, BarangKeluar $barangKeluar)
{
    $this->authorizeRole(['admin', 'manajer']);

    if ($barangKeluar->status_konfirmasi !== 'pending') {
        return back()->withErrors(['error' => 'Transaksi sudah dikonfirmasi dan tidak bisa diperbarui.']);
    }

    $validated = $request->validate([
        'product_id' => 'required|exists:products,id',
        'jumlah' => 'required|integer|min:1',
        'satuan' => 'required|string',
        'tanggal' => 'required|date',
        'status_konfirmasi' => 'required|in:pending,diterima,ditolak',
    ]);

    // Ambil produk yang sebelumnya dan yang baru
    $produkLama = $barangKeluar->product;
    $produkBaru = Product::findOrFail($validated['product_id']);

    // Jika status konfirmasi menjadi 'diterima', cek dan atur stok
    if ($validated['status_konfirmasi'] === 'diterima') {
        // Jika produk diganti atau jumlah berubah
        if ($barangKeluar->product_id != $produkBaru->id || $barangKeluar->jumlah != $validated['jumlah']) {
            // Kembalikan stok lama jika produk tidak sama
            if ($produkLama && $barangKeluar->product_id != $produkBaru->id) {
                $produkLama->stock += $barangKeluar->jumlah;
                $produkLama->save();
            }

            // Kurangi stok baru
            if ($produkBaru->stock < $validated['jumlah']) {
                return back()->withErrors(['jumlah' => 'Stok tidak mencukupi.'])->withInput();
            }
            $produkBaru->stock -= $validated['jumlah'];
            $produkBaru->save();
        }
    }

    $barangKeluar->update($validated);

    $prefix = $this->getPrefixByRole();
    return redirect()->route("{$prefix}.barang_keluar.index")
        ->with('success', 'Transaksi barang keluar berhasil diperbarui.');
}


    public function destroy(Request $request, BarangKeluar $barangKeluar)
    {
        $this->authorizeRole(['admin', 'manajer']);

        if ($barangKeluar->status_konfirmasi === 'diterima') {
            $product = $barangKeluar->product;
            if ($product) {
                $product->stock += $barangKeluar->jumlah;
                $product->save();
            }
        }

        $barangKeluar->delete();

        $prefix = $this->getPrefixByRole();
        return redirect()->route("{$prefix}.barang_keluar.index")
            ->with('success', 'Data barang keluar berhasil dihapus.');
    }
}