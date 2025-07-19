@extends('layouts.app')

@section('title', 'Stock Opname')

@section('content')
@php
    $role = auth()->user()->role;
    $routePrefix = $role === 'manajer' ? 'manajer' : 'staff';
@endphp

<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Stock Opname</h1>
            <p class="text-sm text-gray-500">Catatan pemeriksaan stok fisik produk</p>
        </div>

        <a href="{{ route($routePrefix . '.stock_opname.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            Tambah Stock Opname
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produk</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stok Sistem</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stok Fisik</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Selisih</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($stockOpname as $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap font-semibold text-gray-700">
                        {{ $item->product->nama ?? 'Produk tidak ditemukan' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->stok_sistem }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->stok_fisik }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                            $selisih = $item->stok_fisik - $item->stok_sistem;
                        @endphp

                        @if ($selisih === 0)
                            <span class="inline-block px-2 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded">Sesuai</span>
                        @else
                            <span class="inline-block px-2 py-1 text-xs font-semibold bg-red-100 text-red-700 rounded">
                            {{ $selisih > 0 ? '+' . $selisih : $selisih }}
                            </span>
                        @endif
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap flex gap-2">
                        <a href="{{ route($routePrefix . '.stock_opname.show', $item->id) }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">
                            Detail
                        </a>

                        @if ($role === 'manajer')
                        <form action="{{ route($routePrefix . '.stock_opname.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus data ini?')" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">Hapus</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center px-6 py-4 text-gray-500">Tidak ada data stock opname.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection