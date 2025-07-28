<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
        public function index()
        {
            $data = BarangMasuk::with(['product', 'supplier'])->latest()->get();
            return view('admin.laporan.index', compact('data'));
        }

        public function barangMasukPDF()
        {
            $data = BarangMasuk::with(['product', 'supplier'])->latest()->get(); // FIX: pakai 'product', bukan 'produk'
            $pdf = Pdf::loadView('admin.laporan.barang_masuk_pdf', compact('data'));
            return $pdf->download('laporan_barang_masuk.pdf');
        }

}
