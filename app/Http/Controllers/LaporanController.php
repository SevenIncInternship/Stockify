<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    private function getPrefixByRole()
    {
        $user = auth()->user();
        return match($user->role) {
            'manajer' => 'manajer',
            default => 'admin',
        };
    }

    public function index()
    {
        $data = BarangMasuk::with(['product', 'supplier'])->latest()->get();
        $prefix = $this->getPrefixByRole();
        return view("$prefix.laporan.index", compact('data'));
    }

    public function barangMasukPDF()
    {
        $data = BarangMasuk::with(['product', 'supplier'])->latest()->get();
        $prefix = $this->getPrefixByRole();
        $pdf = Pdf::loadView("$prefix.laporan.barang_masuk_pdf", compact('data'));
        return $pdf->download('laporan_barang_masuk.pdf');
    }
}