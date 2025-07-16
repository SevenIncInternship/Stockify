@extends('layouts.app')

@section('content')
@php
    $rolePrefix = auth()->user()->role === 'manajer' ? 'manajer' : 'admin';
@endphp

<div class="p-6 max-w-xl mx-auto">
    <h1 class="text-xl font-bold mb-4">Tambah Produk</h1>

    <form method="POST" action="{{ route($rolePrefix . '.product.store') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
            <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama Produk" class="w-full border p-2 rounded" required>
            @error('nama')
                <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
            <select name="kategori_id" class="w-full border p-2 rounded" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('kategori_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->nama }}
                    </option>
                @endforeach
            </select>
            @error('kategori_id')
                <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
            <input type="number" name="stock" value="{{ old('stock') }}" placeholder="Stok" class="w-full border p-2 rounded" required>
            @error('stock')
                <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Satuan</label>
            <input type="text" name="satuan" value="{{ old('satuan') }}" placeholder="Satuan (contoh: pcs, kg)" class="w-full border p-2 rounded" required>
            @error('satuan')
                <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow w-full">
            Simpan Produk
        </button>
    </form>
</div>
@endsection