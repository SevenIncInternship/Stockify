@extends('layouts.app')
@section('title', 'Konfirmasi Barang Masuk')

@section('content')
<div class="p-6 bg-white shadow rounded">
    <h2 class="text-xl font-bold mb-4">Konfirmasi Barang Masuk</h2>

    <p><strong>Nama Barang:</strong> {{ $item->product->nama ?? '-' }}</p>
    <p><strong>Jumlah:</strong> {{ $item->jumlah }}</p>
    <p><strong>Satuan:</strong> {{ $item->satuan }}</p>
    <p><strong>Status:</strong> {{ ucfirst($item->status_konfirmasi) }}</p>

    @if($item->status_konfirmasi !== 'Diterima')
    <form action="{{ route('staff.barangMasuk.konfirmasi', $item->id) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')
        <input type="hidden" name="status_konfirmasi" value="diterima">
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Konfirmasi Selesai</button>
    </form>
    @else
    <p class="mt-4 text-green-600 font-semibold">Sudah dikonfirmasi.</p>
    @endif
</div>
@endsection