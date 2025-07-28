@extends('layouts.app')

@section('title', 'Stock Opname')

@section('content')
@php
    $role = auth()->user()->role;
    $routePrefix = $role === 'manajer' ? 'manajer' : 'staff';
@endphp

<div class="container max-w-screen-xl mx-auto p-6">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Stock Opname</h1>
            <p class="text-sm text-gray-500">Catatan pemeriksaan stok fisik produk</p>
        </div>
        <a href="{{ route($routePrefix . '.stock_opname.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow text-sm">
            Tambah Stock Opname
        </a>
    </div>

    {{-- Tabel --}}
    <div class="overflow-x-auto bg-white rounded shadow border border-gray-200">
        <table class="min-w-full table-auto text-sm text-gray-700">
            <thead class="bg-gray-50 text-xs font-semibold uppercase text-gray-600">
                <tr>
                    <th class="px-6 py-3 text-left">Produk</th>
                    <th class="px-6 py-3 text-left">Stok Sistem</th>
                    <th class="px-6 py-3 text-left">Stok Fisik</th>
                    <th class="px-6 py-3 text-left">Selisih</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($stockOpname as $item)
                    @php
                        $selisih = $item->stok_fisik - $item->stok_sistem;
                        $selisihLabel = $selisih === 0
                            ? '<span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded">Sesuai</span>'
                            : '<span class="px-2 py-1 text-xs font-semibold bg-red-100 text-red-700 rounded">'.($selisih > 0 ? '+' : '').$selisih.'</span>';
                    @endphp
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap font-semibold text-gray-800">
                            {{ $item->product->nama ?? 'Produk tidak ditemukan' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->stok_sistem }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->stok_fisik }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{!! $selisihLabel !!}</td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center items-center gap-3">
                                <a href="{{ route($routePrefix . '.stock_opname.show', $item->id) }}"
                                   class="text-blue-600 hover:underline text-sm">Detail</a>

                                @if ($role === 'manajer')
                                    <form action="{{ route($routePrefix . '.stock_opname.destroy', $item->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin hapus data ini?');"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline text-sm">Hapus</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center px-6 py-4 text-gray-500">
                            Tidak ada data stock opname.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection