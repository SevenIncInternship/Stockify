@extends('layouts.app')

@section('content')
@php
    $rolePrefix = auth()->user()->role === 'manajer' ? 'manajer' : 'admin';
@endphp

<div class="p-6 max-w-xl mx-auto">
    <h1 class="text-xl font-bold mb-4">Edit Produk</h1>

    <form method="POST" action="{{ route($rolePrefix . '.product.update', $product->id) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
            <input type="text" name="nama" value="{{ old('nama', $product->nama) }}" class="w-full border p-2 rounded" required>
            @error('nama')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
            <select name="kategori_id" class="w-full border p-2 rounded">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->nama }}
                    </option>
                @endforeach
            </select>
            @error('kategori_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full border p-2 rounded" required>
            @error('stock')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Satuan</label>
            <input type="text" name="satuan" value="{{ old('satuan', $product->satuan) }}" class="w-full border p-2 rounded" required>
            @error('satuan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow w-full">
            Update Produk
        </button>
    </form>
</div>
@endsection