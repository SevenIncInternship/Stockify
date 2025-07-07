<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BarangMasukController extends Controller
{
    /**
     * Menampilkan daftar barang masuk
     */
    public function index(): View
    {
        $barangMasuk = BarangMasuk::latest()->paginate(10);

        return view('barang_masuk.index', compact('barangMasuk'));
    }

    /**
     * Menampilkan form untuk membuat barang masuk baru
     */
    public function create(): View
    {
        return view('barang_masuk.create');
    }

    /**
     * Menyimpan barang masuk baru
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'required|string|max:50',
        ]);

        $validated['tanggal'] = now()->toDateString();

        try {
            $barangMasuk = BarangMasuk::create($validated);

            return redirect()->route('barang_masuk.index')
                ->with('success', 'Barang masuk berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan detail barang masuk (AJAX)
     */
    public function show(BarangMasuk $barangMasuk)
    {
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $barangMasuk->id,
                    'nama_barang' => $barangMasuk->nama_barang,
                    'jumlah' => $barangMasuk->jumlah,
                    'satuan' => $barangMasuk->satuan,
                    'tanggal' => $barangMasuk->tanggal->format('d-m-Y'),
                    'created_at' => $barangMasuk->created_at->format('d-m-Y H:i:s'),
                    'updated_at' => $barangMasuk->updated_at->format('d-m-Y H:i:s'),
                ]
            ]);
        }

        return view('barang_masuk.show', compact('barangMasuk'));
    }

    /**
     * Menampilkan form edit barang masuk
     */
    public function edit(BarangMasuk $barangMasuk): View
    {
        return view('barang_masuk.edit', compact('barangMasuk'));
    }

    /**
     * Update barang masuk
     */
    public function update(Request $request, BarangMasuk $barangMasuk): RedirectResponse
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'required|string|max:50',
        ]);

        try {
            $barangMasuk->update($validated);

            return redirect()->route('barang_masuk.index')
                ->with('success', 'Barang masuk berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Hapus barang masuk
     */
    public function destroy(BarangMasuk $barangMasuk): RedirectResponse
    {
        try {
            $barangMasuk->delete();

            return redirect()->route('barang_masuk.index')
                ->with('success', 'Barang masuk berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}
