@extends('layouts.app')
@section('title', 'Dashboard Staff Gudang')
@section('content')
<div class="space-y-6">

    <!-- Section: Tugas Harian -->
    <div class="bg-white shadow rounded p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">📋 Tugas Harian</h2>

        @if($barangMasukPending->isEmpty() && $barangKeluarPending->isEmpty())
            <p class="text-gray-500">Tidak ada tugas harian yang menunggu konfirmasi.</p>
        @else
            <ul class="space-y-3">
                @foreach($barangMasukPending as $bm)
                    <li class="flex items-center justify-between bg-blue-50 p-3 rounded">
                        <div class="text-blue-800">
                            <span class="font-medium"> 
                            @if ($bm->product)
                                Barang Masuk: {{ $bm->product->nama }} ({{ $bm->jumlah }} {{ $bm->satuan }})
                            @else
                                Barang Masuk: [Produk tidak ditemukan] ({{ $bm->jumlah }} {{ $bm->satuan }})
                            @endif
                            </span>

                        </div>
                        <a href="{{ route('staff.barangMasuk.konfirmasi', $bm->id) }}"
                            class="text-sm text-white bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded">
                            Konfirmasi
                        </a>
                    </li>
                @endforeach

                @foreach($barangKeluarPending as $bk)
                    <li class="flex items-center justify-between bg-red-50 p-3 rounded">
                        <div class="text-red-800">
                            <span class="font-medium"> 
                            @if ($bk->product)
                                Barang Keluar: {{ $bk->product->nama }} ({{ $bk->jumlah }} {{ $bk->satuan }})
                            @else
                                Barang Keluar: [Produk tidak ditemukan] ({{ $bk->jumlah }} {{ $bk->satuan }})
                            @endif
                            </span>
                        </div>
                        <a href="{{ route('staff.barangKeluar.konfirmasi', $bk->id) }}"
                            class="text-sm text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded">
                            Konfirmasi
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <!-- Section: Stock Opname -->
    <div class="bg-white shadow rounded p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">📦 Stock Opname</h2>
        <p class="text-gray-600 mb-4">Lakukan pencatatan stok barang yang tersedia di gudang secara berkala.</p>
        <a href="{{ route('staff.stock_opname.index') }}" 
            class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded transition">
            ➕ Lihat & Catat Stock Opname
        </a>
    </div>
</div>
@endsection