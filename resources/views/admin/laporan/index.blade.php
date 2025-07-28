@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold text-slate-800 mb-6">Laporan Transaksi - Barang Masuk</h1>

    {{-- Tombol Download PDF --}}
    <div class="mb-4">
        <a href="{{ route('admin.laporan.barangMasuk.pdf') }}"
           class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded shadow">
            <i class="fas fa-file-pdf mr-2"></i> Download PDF
        </a>
    </div>

    {{-- Tabel Laporan --}}
    <div class="overflow-x-auto bg-white rounded shadow border border-slate-200">
        <table class="min-w-full divide-y divide-slate-200 text-sm text-slate-700">
            <thead class="bg-slate-100 text-left text-xs font-semibold uppercase text-slate-600">
                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Tanggal</th>
                    <th class="px-4 py-3">Kode Barang</th>
                    <th class="px-4 py-3">Nama Barang</th>
                    <th class="px-4 py-3">Jumlah</th>
                    <th class="px-4 py-3">Supplier</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($data as $index => $item)
                    <tr>
                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ $item->tanggal?->format('d-m-Y') ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $item->product->SKU ?? '-' }}</td>         {{-- CASE FIX --}}
                        <td class="px-4 py-2">{{ $item->product->nama ?? '-' }}</td>       {{-- CASE FIX --}}
                        <td class="px-4 py-2">{{ $item->jumlah }}</td>
                        <td class="px-4 py-2">{{ $item->supplier->nama ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-4 text-center text-slate-500">Data tidak tersedia.</td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>
@endsection
