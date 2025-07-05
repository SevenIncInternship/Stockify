<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\BarangMasuk;

class LaporanController extends Controller
{
    public function barangMasukPDF()
    {
        $data = BarangMasuk::with('produk', 'supplier')->get();
        $pdf = Pdf::loadView('admin.laporan.barang_masuk_pdf', compact('data'));
        return $pdf->download('laporan-barang-masuk.pdf');
    }
}
