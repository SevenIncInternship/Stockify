@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
@php
    $rolePrefix = auth()->user()->role === 'manajer' ? 'manajer' : 'admin';
@endphp

<div class="p-6 max-w-xl mx-auto">
    <h1 class="text-xl font-bold mb-4">Tambah Produk</h1>

    <form method="POST" action="{{ route($rolePrefix . '.product.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label>Nama Produk</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="w-full border p-2 rounded">
            @error('nama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Kategori</label>
            <select name="category_id" class="w-full border p-2 rounded">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->nama }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Supplier</label>
            <select name="supplier_id" class="w-full border p-2 rounded">
                <option value="">-- Pilih Supplier --</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->nama }}
                    </option>
                @endforeach
            </select>
            @error('supplier_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Satuan</label>
            <input type="text" name="satuan" value="{{ old('satuan') }}" class="w-full border p-2 rounded">
            @error('satuan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Harga Beli</label>
            <input type="number" name="harga_beli" value="{{ old('harga_beli') }}" class="w-full border p-2 rounded">
            @error('harga_beli') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Harga Jual</label>
            <input type="number" name="harga_jual" value="{{ old('harga_jual') }}" class="w-full border p-2 rounded">
            @error('harga_jual') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Minimal Stok</label>
            <input type="number" name="minimal_stok" value="{{ old('minimal_stok') }}" class="w-full border p-2 rounded">
            @error('minimal_stok') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Gambar (Opsional)</label>
            <input type="file" name="image" class="w-full border p-2 rounded">
            @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow w-full">
            Simpan Produk
        </button>
    </form>
</div>
@endsection
