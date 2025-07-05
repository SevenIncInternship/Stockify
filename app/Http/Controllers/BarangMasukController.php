<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    /**
     * Menampilkan daftar semua barang masuk.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $barangMasuk = BarangMasuk::all();
        return view('barang_masuk.index', compact('barangMasuk'));
    }

    /**
     * Menampilkan form untuk membuat barang masuk baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('barang_masuk.create');
    }

    /**
     * Menyimpan barang masuk baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'required|string|max:50',
            'tanggal_masuk' => 'nullable|date',
            'supplier' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:500',
        ]);

        // Set default status sebagai pending
        $validated['status'] = 'pending';
        
        // Set tanggal masuk jika tidak diisi
        if (!isset($validated['tanggal_masuk'])) {
            $validated['tanggal_masuk'] = now();
        }

        BarangMasuk::create($validated);
        
        return redirect()->route('admin.barang_masuk.index')->with('success', 'Barang masuk berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail barang masuk tertentu.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        return view('barang_masuk.show', compact('barangMasuk'));
    }

    /**
     * Menampilkan form untuk mengedit barang masuk.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        return view('barang_masuk.edit', compact('barangMasuk'));
    }

    /**
     * Memperbarui barang masuk yang sudah ada di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'required|string|max:50',
            'tanggal_masuk' => 'nullable|date',
            'supplier' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:500',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $barangMasuk->update($validated);
        
        return redirect()->route('admin.barang_masuk.index')->with('success', 'Barang masuk berhasil diperbarui.');
    }

    /**
     * Menghapus barang masuk dari database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        $barangMasuk->delete();
        
        return redirect()->route('admin.barang_masuk.index')->with('success', 'Barang masuk berhasil dihapus.');
    }

    /**
     * Menyetujui barang masuk (approve).
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        $barangMasuk->update(['status' => 'approved']);
        
        return redirect()->route('admin.barang_masuk.index')->with('success', 'Barang masuk berhasil disetujui.');
    }

    /**
     * Menolak barang masuk (reject).
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reject($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        $barangMasuk->update(['status' => 'rejected']);
        
        return redirect()->route('admin.barang_masuk.index')->with('success', 'Barang masuk berhasil ditolak.');
    }

    /**
     * Menampilkan daftar barang masuk berdasarkan status.
     *
     * @param  string  $status
     * @return \Illuminate\View\View
     */
    public function filterByStatus($status)
    {
        $validStatuses = ['pending', 'approved', 'rejected'];
        
        if (!in_array($status, $validStatuses)) {
            abort(404, 'Status tidak valid.');
        }
        
        $barangMasuk = BarangMasuk::where('status', $status)->get();
        
        return view('barang_masuk.index', compact('barangMasuk', 'status'));
    }

    /**
     * Menampilkan laporan barang masuk.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function report(Request $request)
    {
        $query = BarangMasuk::query();
        
        // Filter berdasarkan tanggal jika ada
        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('tanggal_masuk', '>=', $request->start_date);
        }
        
        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('tanggal_masuk', '<=', $request->end_date);
        }
        
        // Filter berdasarkan status jika ada
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        $barangMasuk = $query->orderBy('tanggal_masuk', 'desc')->get();
        
        return view('barang_masuk.report', compact('barangMasuk'));
    }
}