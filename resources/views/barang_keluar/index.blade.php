@php
    $rolePrefix = auth()->user()->role;
@endphp

@extends('layouts.app')

@section('title', 'Barang Keluar')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Barang Keluar - {{ ucfirst($rolePrefix) }}</h1>
            <p class="text-sm text-gray-500">Daftar semua barang keluar yang tercatat di sistem</p>
        </div>
        <a href="{{ route($rolePrefix . '.barang_keluar.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Tambah Barang Keluar</a>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($barangKeluar as $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->product->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->jumlah }} {{ $item->satuan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                            switch ($item->status_konfirmasi) {
                                case 'pending':
                                    $badgeColor = 'bg-yellow-100 text-yellow-800';
                                    break;
                                case 'diterima':
                                    $badgeColor = 'bg-green-100 text-green-800';
                                    break;
                                case 'ditolak':
                                    $badgeColor = 'bg-red-100 text-red-800';
                                    break;
                                default:
                                    $badgeColor = 'bg-gray-100 text-gray-800';
                            }
                        @endphp
                        <span class="px-2 py-1 rounded text-xs font-semibold {{ $badgeColor }}">
                            {{ ucfirst($item->status_konfirmasi) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap flex gap-2">
                        <a href="{{ route($rolePrefix . '.barang_keluar.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form action="{{ route($rolePrefix . '.barang_keluar.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach

                @if ($barangKeluar->isEmpty())
                <tr>
                    <td colspan="5" class="text-center px-6 py-4 text-gray-500">
                        Belum ada data barang keluar.
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
