<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManajerLaporanController extends Controller
{
    public function index() {
        return view('manajer.laporan.index');
    }
}
