@extends('layouts.app')
@section('title', 'Konfirmasi Barang Keluar')

@section('content')
<div class="p-6 bg-white shadow rounded space-y-4">

    {{-- Alert jika ada pesan sukses --}}
    @if(session('success'))
        <div class="bg-blue-100 text-blue-800 p-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="text-xl font-bold">Konfirmasi Barang Keluar</h2>

    <div class="space-y-1">
        <p><strong>Nama Barang:</strong> {{ $item->nama_barang }}</p>
        <p><strong>Jumlah:</strong> {{ $item->jumlah }}</p>
        <p><strong>Satuan:</strong> {{ $item->satuan }}</p>
        <p><strong>Status:</strong> <span class="capitalize">{{ $item->status }}</span></p>
    </div>

    @if($item->status !== 'selesai')
        <form action="{{ route('staff.barangKeluar.konfirmasi', $item->id) }}" method="POST">
            @csrf
            @method('PUT')
            <x-button class="bg-blue-600 hover:bg-blue-700">Konfirmasi Selesai</x-button>
        </form>
    @else
        <p class="mt-4 text-blue-600 font-semibold">Transaksi ini sudah dikonfirmasi.</p>
    @endif

</div>
@endsection
@extends('layouts.app')
@section('title', 'Konfirmasi Barang Keluar')
@section('content')
<div class="p-6 bg-white shadow rounded">
    <h2 class="text-xl font-bold mb-4">Konfirmasi Barang Keluar</h2>
    <p><strong>Nama Barang:</strong> {{ $item->nama_barang }}</p>
    <p><strong>Jumlah:</strong> {{ $item->jumlah }}</p>
    <p><strong>Satuan:</strong> {{ $item->satuan }}</p>
    <p><strong>Status:</strong> {{ $item->status }}</p>

    @if($item->status !== 'selesai')
    <form action="{{ route('staff.barangKeluar.konfirmasi', $item->id) }}" method="POST" class="mt-4">
        @csrf @method('PUT')
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Konfirmasi Selesai</button>
    </form>
    @else
    <p class="mt-4 text-blue-600 font-semibold">Sudah dikonfirmasi.</p>
    @endif
</div>
@endsection
