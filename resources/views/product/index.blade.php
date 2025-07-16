@php
    $rolePrefix = auth()->user()->role;
@endphp

@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Daftar Produk - {{ ucfirst($rolePrefix) }}</h1>
            <p class="text-sm text-gray-500">Kelola data produk di sistem</p>
        </div>

        @if ($rolePrefix === 'admin')
        <a href="{{ route($rolePrefix . '.product.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
            + Tambah Produk
        </a>
        @endif
    </div>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Produk</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Supplier</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Satuan</th>
                    @if ($rolePrefix === 'admin')
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($products as $product)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $product->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $product->category?->nama ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $product->supplier?->nama ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $product->stock }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $product->satuan }}</td>

                    @if ($rolePrefix === 'admin')
                    <td class="px-6 py-4 whitespace-nowrap flex gap-2">
                        <a href="{{ route($rolePrefix . '.product.edit', $product->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form action="{{ route($rolePrefix . '.product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                        </form>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="{{ $rolePrefix === 'admin' ? '6' : '5' }}" class="px-6 py-4 text-center text-gray-500">
                        Belum ada data produk.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection