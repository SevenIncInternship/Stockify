@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
@php
    $rolePrefix = auth()->user()->role === 'manajer' ? 'manajer' : 'admin';
@endphp

<div class="p-6 max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Daftar Produk - {{ ucfirst($rolePrefix) }}</h1>
            <p class="text-sm text-gray-500">Kelola data produk di sistem</p>
        </div>

        @if ($rolePrefix === 'admin')
            <a href="{{ route($rolePrefix . '.product.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
                + Tambah Produk
            </a>
        @endif
    </div>

    @if (session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full table-auto text-sm">
            <thead class="bg-gray-50 text-gray-700 font-semibold">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Produk</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKU</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Supplier</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Satuan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Beli</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Jual</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Minimal Stok</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->nama }}" class="w-16 h-16 object-cover rounded">
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-3">{{ $product->nama }}</td>
                        <td class="px-6 py-3">{{ $product->SKU }}</td>
                        <td class="px-6 py-3">{{ $product->category?->nama ?? '-' }}</td>
                        <td class="px-6 py-3">{{ $product->supplier?->nama ?? '-' }}</td>
                        <td class="px-6 py-3">{{ $product->stock }}</td>
                        <td class="px-6 py-3">{{ $product->satuan }}</td>
                        <td class="px-6 py-3">Rp {{ number_format($product->harga_beli, 0, ',', '.') }}</td>
                        <td class="px-6 py-3">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</td>
                        <td class="px-6 py-3">{{ $product->minimal_stok }}</td>
                        <td class="px-6 py-3 text-center whitespace-nowrap">
                            <div class="flex gap-2 justify-center">
                                <a href="{{ route($rolePrefix . '.product.edit', $product->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                @if ($rolePrefix === 'admin')
                                    <form action="{{ route($rolePrefix . '.product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="px-6 py-4 text-center text-gray-500">Belum ada data produk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection