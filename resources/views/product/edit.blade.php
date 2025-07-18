@php
    $rolePrefix = auth()->user()->role === 'manajer' ? 'manajer' : 'admin';
@endphp

@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="p-6 max-w-xl mx-auto">
    <h1 class="text-xl font-bold mb-4">Edit Produk</h1>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 p-3 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route($rolePrefix . '.product.update', $product->id) }}" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label>Nama Produk</label>
            <input type="text" name="nama" value="{{ old('nama', $product->nama) }}" class="w-full border p-2 rounded">
        </div>

        <div>
            <label>Kategori</label>
            <select name="kategori_id" class="w-full border p-2 rounded">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('kategori_id', $product->kategori_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Supplier</label>
            <select name="supplier_id" class="w-full border p-2 rounded">
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Satuan</label>
            <input type="text" name="satuan" value="{{ old('satuan', $product->satuan) }}" class="w-full border p-2 rounded">
        </div>

        <div>
            <label>Harga Beli</label>
            <input type="number" name="harga_beli" value="{{ old('harga_beli', $product->harga_beli) }}" class="w-full border p-2 rounded">
        </div>

        <div>
            <label>Harga Jual</label>
            <input type="number" name="harga_jual" value="{{ old('harga_jual', $product->harga_jual) }}" class="w-full border p-2 rounded">
        </div>

        <div>
            <label>Minimal Stok</label>
            <input type="number" name="minimal_stok" value="{{ old('minimal_stok', $product->minimal_stok) }}" class="w-full border p-2 rounded">
        </div>

        <div>
            <label>Gambar (Opsional)</label>
            @if ($product->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-24 h-24 object-cover rounded">
                </div>
            @endif
            <input type="file" name="image" class="w-full border p-2 rounded">
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow w-full">
            Update Produk
        </button>
    </form>
</div>
@endsection
