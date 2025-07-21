<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\Product;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barangKeluar = BarangKeluar::with('product')->latest()->paginate(10);
        return view('barang_keluar.index', compact('barangKeluar'));
    }

    public function create(Request $request)
{
    $products = Product::all();

    $userRole = $request->user()->role;
    $rolePrefix = match ($userRole) {
        'admin' => 'admin',
        'manajer' => 'manajer',
        'staff' => 'staff',
        default => 'guest', // fallback jika tidak cocok
    };

    return view('barang_keluar.create', compact('products', 'rolePrefix'));
}


    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'jumlah'     => 'required|integer|min:1',
            'satuan'     => 'required|string',
            'tanggal'    => 'required|date',
            'status_konfirmasi' => 'nullable|in:pending,diterima,ditolak',
        ]);

        $userRole = $request->user()->role;

        // Role-based assignment
        if ($userRole === 'staff') {
            $validated['status_konfirmasi'] = 'pending';
        } elseif ($userRole === 'manajer') {
            // Manajer hanya bisa pilih pending atau diterima (dipastikan dari blade)
            $validated['status_konfirmasi'] = $validated['status_konfirmasi'] ?? 'pending';
        } elseif ($userRole === 'admin') {
            // Admin bisa pilih semua status
            $validated['status_konfirmasi'] = $validated['status_konfirmasi'] ?? 'pending';
        }

        $product = Product::findOrFail($validated['product_id']);

        // Jika status diterima, cek stok
        if ($validated['status_konfirmasi'] === 'diterima') {
            if ($product->stock < $validated['jumlah']) {
                return back()->withErrors(['jumlah' => 'Stok tidak mencukupi.'])->withInput();
            }
            $product->stock -= $validated['jumlah'];
            $product->save();
        }

        BarangKeluar::create($validated);

        return redirect()->route('admin.barang_keluar.index')
            ->with('success', 'Barang keluar berhasil ditambahkan.');
    }

    public function edit(Request $request, BarangKeluar $barangKeluar)
    {
        if ($request->user()->role === 'staff') {
            return back()->withErrors(['error' => 'Anda tidak memiliki izin untuk mengedit.']);
        }

        if ($barangKeluar->status_konfirmasi !== 'pending') {
            return back()->withErrors(['error' => 'Transaksi sudah dikonfirmasi dan tidak bisa diedit.']);
        }

        $products = Product::all();
        return view('barang_keluar.edit', compact('barangKeluar', 'products'));
    }

    public function update(Request $request, BarangKeluar $barangKeluar)
    {
        if ($request->user()->role === 'staff') {
            return back()->withErrors(['error' => 'Anda tidak memiliki izin untuk memperbarui data ini.']);
        }

        if ($barangKeluar->status_konfirmasi !== 'pending') {
            return back()->withErrors(['error' => 'Transaksi sudah dikonfirmasi dan tidak bisa diperbarui.']);
        }

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'jumlah'     => 'required|integer|min:1',
            'satuan'     => 'required|string',
            'tanggal'    => 'required|date',
            'status_konfirmasi' => 'required|in:pending,diterima,ditolak',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if ($validated['status_konfirmasi'] === 'diterima') {
            if ($product->stock < $validated['jumlah']) {
                return back()->withErrors(['jumlah' => 'Stok tidak mencukupi.'])->withInput();
            }
            $product->stock -= $validated['jumlah'];
            $product->save();
        }

        $barangKeluar->update($validated);

        return redirect()->route('admin.barang_keluar.index')
            ->with('success', 'Transaksi barang keluar berhasil diperbarui.');
    }

    public function destroy(Request $request, BarangKeluar $barangKeluar)
    {
        if ($request->user()->role === 'staff') {
            return back()->withErrors(['error' => 'Anda tidak memiliki izin untuk menghapus data ini.']);
        }

        if ($barangKeluar->status_konfirmasi === 'diterima') {
            $product = $barangKeluar->product;
            if ($product) {
                $product->stock += $barangKeluar->jumlah;
                $product->save();
            }
        }

        $barangKeluar->delete();

        return redirect()->route('admin.barang_keluar.index')
            ->with('success', 'Data barang keluar berhasil dihapus.');
    }
}