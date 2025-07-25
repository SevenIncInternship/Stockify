<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function barangMasukPDF()
    {
        $data = BarangMasuk::latest()->get();
        $pdf = Pdf::loadView('laporan.barang_masuk_pdf', compact('data'));
        return $pdf->download('laporan_barang_masuk.pdf');
    }
}
