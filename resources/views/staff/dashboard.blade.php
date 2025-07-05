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
</div>
@endsection
