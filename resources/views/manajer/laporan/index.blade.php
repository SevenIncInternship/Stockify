@extends('layouts.app')

@section('title', 'Laporan Barang Masuk')

@section('content')
<div class="container max-w-screen-xl mx-auto p-6">
    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Laporan Barang Masuk</h1>
            <p class="text-sm text-gray-500">Daftar transaksi barang masuk</p>
        </div>
        <a href="{{ route('manajer.laporan.barangMasuk.pdf') }}"
           class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded shadow text-sm">
            <i class="fas fa-file-pdf mr-2"></i> Download PDF
        </a>
    </div>

    {{-- Tabel --}}
    <div class="overflow-x-auto bg-white rounded shadow border border-gray-200">
        <table class="min-w-full table-fixed text-sm text-gray-700">
    <thead class="bg-gray-50 text-xs font-semibold uppercase text-gray-600">
        <tr>
            <th class="w-12 px-4 py-3 text-left">No</th>
            <th class="w-32 px-4 py-3 text-left">Tanggal</th>
            <th class="w-48 px-4 py-3 text-left">SKU</th>
            <th class="w-56 px-4 py-3 text-left">Nama Produk</th>
            <th class="w-32 px-4 py-3 text-left">Jumlah</th>
            <th class="w-56 px-4 py-3 text-left">Supplier</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-100">
        @forelse ($data as $index => $item)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-2">{{ $index + 1 }}</td>
                <td class="px-4 py-2">{{ $item->tanggal?->format('d-m-Y') ?? '-' }}</td>
                <td class="px-4 py-2">{{ $item->product->SKU ?? '-' }}</td>
                <td class="px-4 py-2">{{ $item->product->nama ?? '-' }}</td>
                <td class="px-4 py-2">{{ $item->jumlah }} {{ $item->satuan }}</td>
                <td class="px-4 py-2">{{ $item->supplier->nama ?? '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center px-4 py-4 text-gray-500">
                    Tidak ada data barang masuk.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

    </div>
</div>
@endsection