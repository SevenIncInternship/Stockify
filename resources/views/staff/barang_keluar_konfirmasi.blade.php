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
