@extends('layouts.app')
@section('title', 'Dashboard Staff Gudang')

@section('content')
<div class="space-y-6">

    <div class="bg-white p-4 shadow rounded">
        <h2 class="text-xl font-bold mb-4">Tugas Harian</h2>

        {{-- Jika tidak ada tugas --}}
        @if($barangMasukPending->isEmpty() && $barangKeluarPending->isEmpty())
            <p class="text-gray-500 italic">Tidak ada barang masuk atau keluar yang perlu dikonfirmasi hari ini.</p>
        @endif

        {{-- Barang Masuk --}}
        @if(!$barangMasukPending->isEmpty())
            <h3 class="font-semibold text-slate-700 mb-1">Barang Masuk:</h3>
            <ul class="list-disc ml-6 mb-4">
                @foreach($barangMasukPending as $bm)
                    <li>
                        {{ $bm->nama_barang }} ({{ $bm->jumlah }} {{ $bm->satuan }})
                        <a href="{{ route('staff.barangMasuk.konfirmasi', $bm->id) }}" class="text-blue-600 hover:underline ml-2">Konfirmasi</a>
                    </li>
                @endforeach
            </ul>
        @endif

        {{-- Barang Keluar --}}
        @if(!$barangKeluarPending->isEmpty())
            <h3 class="font-semibold text-slate-700 mb-1">Barang Keluar:</h3>
            <ul class="list-disc ml-6">
                @foreach($barangKeluarPending as $bk)
                    <li>
                        {{ $bk->nama_barang }} ({{ $bk->jumlah }} {{ $bk->satuan }})
                        <a href="{{ route('staff.barangKeluar.konfirmasi', $bk->id) }}" class="text-blue-600 hover:underline ml-2">Konfirmasi</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

</div>
@endsection
@extends('layouts.app')
@section('title', 'Dashboard Staff Gudang')
@section('content')
<div class="space-y-6">
    <div class="bg-white p-4 shadow rounded">
        <h2 class="text-xl font-bold mb-2">Tugas Harian</h2>
        <ul class="list-disc ml-5">
            @foreach($barangMasukPending as $bm)
                <li>Barang Masuk: {{ $bm->nama_barang }} ({{ $bm->jumlah }} {{ $bm->satuan }})
                    <a href="{{ route('staff.barangMasuk.konfirmasi', $bm->id) }}" class="text-blue-500 underline ml-2">Konfirmasi</a>
                </li>
            @endforeach

            @foreach($barangKeluarPending as $bk)
                <li>Barang Keluar: {{ $bk->nama_barang }} ({{ $bk->jumlah }} {{ $bk->satuan }})
                    <a href="{{ route('staff.barangKeluar.konfirmasi', $bk->id) }}" class="text-blue-500 underline ml-2">Konfirmasi</a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="bg-white p-4 shadow rounded">
        <h2 class="text-xl font-bold mb-2">Stock Opname</h2>
        <a href="{{ route('staff.stock_opname.index') }}" 
            class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded transition-all duration-200">
            Lihat & Catat Stock Opname
        </a>
    </div>
</div>
@endsection