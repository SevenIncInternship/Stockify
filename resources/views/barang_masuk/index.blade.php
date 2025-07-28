@php
    $rolePrefix = auth()->user()->role;
@endphp

@extends('layouts.app')

@section('title', 'Barang Masuk')

@section('content')
<div class="container max-w-screen-xl mx-auto p-6">

    {{-- Notifikasi sukses --}}
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Notifikasi error --}}
    @if ($errors->has('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded shadow-sm">
            {{ $errors->first('error') }}
        </div>
    @endif

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Barang Masuk - {{ ucfirst($rolePrefix) }}</h1>
            <p class="text-sm text-gray-500">Daftar semua barang masuk yang tercatat di sistem</p>
        </div>
        <a href="{{ route($rolePrefix . '.barang_masuk.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow text-sm">
            Tambah Barang Masuk
        </a>
    </div>

    {{-- Tabel --}}
    <div class="overflow-x-auto bg-white rounded shadow border border-gray-200">
        <table class="min-w-full table-auto text-sm text-gray-700">
            <thead class="bg-gray-50 text-xs font-semibold uppercase text-gray-600">
                <tr>
                    <th class="px-6 py-3 text-left">Produk</th>
                    <th class="px-6 py-3 text-left">Jumlah</th>
                    <th class="px-6 py-3 text-left">Tanggal</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($barangMasuk as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->product->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->jumlah }} {{ $item->satuan }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusColor = match($item->status_konfirmasi) {
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'diterima' => 'bg-green-100 text-green-800',
                                    'ditolak' => 'bg-red-100 text-red-800',
                                    default => 'bg-gray-100 text-gray-800',
                                };
                            @endphp
                            <span class="px-2 py-1 rounded text-xs font-semibold {{ $statusColor }}">
                                {{ ucfirst($item->status_konfirmasi) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            <div class="flex gap-3 justify-center items-center">
                                <a href="{{ route($rolePrefix . '.barang_masuk.edit', $item->id) }}"
                                   class="text-indigo-600 hover:text-indigo-900 text-sm"> Edit</a>
                                <form action="{{ route($rolePrefix . '.barang_masuk.destroy', $item->id) }}"
                                      method="POST" onsubmit="return confirm('Yakin ingin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 text-sm"> Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center px-6 py-4 text-gray-500">
                            Tidak ada data barang masuk.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection