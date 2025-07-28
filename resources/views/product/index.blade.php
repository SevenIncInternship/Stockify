@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
@php
    $rolePrefix = auth()->user()->role === 'manajer' ? 'manajer' : 'admin';
    $jumlahProdukKosongSKU = \App\Models\Product::whereNull('sku')->count();
@endphp

<div class="container max-w-screen-xl mx-auto p-6">
    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Daftar Produk - {{ ucfirst($rolePrefix) }}</h1>
            <p class="text-sm text-gray-500">Kelola data produk di sistem</p>
        </div>
        @if ($rolePrefix === 'admin')
            <a href="{{ route($rolePrefix . '.product.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow text-sm">
                Tambah Produk
            </a>
        @endif
    </div>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- SKU kosong --}}
    @if ($rolePrefix === 'admin' && $jumlahProdukKosongSKU > 0)
        <div class="mb-4 flex items-center justify-between bg-yellow-50 border border-yellow-300 text-yellow-800 px-4 py-3 rounded shadow text-sm">
            <div>
                <strong>{{ $jumlahProdukKosongSKU }}</strong> produk belum memiliki SKU.
            </div>
            <a href="{{ route('admin.product.generateSku') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded text-sm">
                🔁 Generate SKU Kosong
            </a>
        </div>
    @endif

    {{-- Tabel Produk --}}
    <div class="overflow-x-auto rounded border border-gray-200 shadow-sm bg-white">
        <table class="min-w-full text-sm text-gray-700 table-auto">
            <thead class="bg-gray-50 text-gray-700 font-semibold sticky top-0 z-10">
                <tr>
                    <th class="px-6 py-3 text-left">Gambar</th>
                    <th class="px-6 py-3 text-left">Nama Produk</th>
                    <th class="px-6 py-3 text-left">SKU</th>
                    <th class="px-6 py-3 text-left">Kategori</th>
                    <th class="px-6 py-3 text-left">Supplier</th>
                    <th class="px-6 py-3 text-right">Stok</th>
                    <th class="px-6 py-3 text-left">Satuan</th>
                    <th class="px-6 py-3 text-right">Harga Beli</th>
                    <th class="px-6 py-3 text-right">Harga Jual</th>
                    <th class="px-6 py-3 text-right">Minimal Stok</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     alt="{{ $product->nama }}"
                                     class="w-16 h-16 object-cover rounded shadow border" />
                            @else
                                <div class="w-16 h-16 flex items-center justify-center bg-gray-100 text-gray-400 rounded text-xs">
                                    Tidak ada
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-3 text-center">{{ $product->nama }}</td>
                        <td class="px-6 py-3 text-right">{{ $product->SKU ?? '-' }}</td>
                        <td class="px-6 py-3 text-center">{{ $product->category?->nama ?? '-' }}</td>
                        <td class="px-6 py-3 text-center">{{ $product->supplier?->nama ?? '-' }}</td>
                        <td class="px-6 py-3 text-center">{{ $product->stock }}</td>
                        <td class="px-6 py-3 text-center">{{ $product->satuan }}</td>
                        <td class="px-6 py-3 text-center">Rp {{ number_format($product->harga_beli, 0, ',', '.') }}</td>
                        <td class="px-6 py-3 text-center">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</td>
                        <td class="px-6 py-3 text-center">{{ $product->minimal_stok }}</td>
                        <td class="px-6 py-3 text-center whitespace-nowrap">
                            <div class="flex gap-3 justify-center items-center">
                                <a href="{{ route($rolePrefix . '.product.edit', $product->id) }}"
                                   class="inline-flex items-center gap-1 text-indigo-600 hover:text-indigo-900 text-sm">
                                     Edit
                                </a>
                                @if ($rolePrefix === 'admin')
                                    <form action="{{ route($rolePrefix . '.product.destroy', $product->id) }}"
                                          method="POST" onsubmit="return confirm('Yakin ingin hapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center gap-1 text-red-600 hover:text-red-900 text-sm">
                                             Hapus
                                        </button>
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