@php
    $rolePrefix = auth()->user()->role === 'manajer' ? 'manajer' : 'admin';
@endphp

@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit Produk</h1>

    @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-lg">
            <ul class="list-disc list-inside text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route($rolePrefix . '.product.update', $product->id) }}" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        {{-- Nama Produk --}}
        <div>
            <label class="block text-sm text-gray-600 mb-1">Nama Produk</label>
            <input type="text" name="nama" value="{{ old('nama', $product->nama) }}"
                class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 p-2" />
        </div>

        {{-- Kategori --}}
        <div>
            <label class="block text-sm text-gray-600 mb-1">Kategori</label>
            <select name="kategori_id" class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 p-2">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('kategori_id', $product->kategori_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Supplier --}}
        <div>
            <label class="block text-sm text-gray-600 mb-1">Supplier</label>
            <select name="supplier_id" class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 p-2">
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Satuan --}}
        <div>
            <label class="block text-sm text-gray-600 mb-1">Satuan</label>
            <input type="text" name="satuan" value="{{ old('satuan', $product->satuan) }}"
                class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 p-2" />
        </div>

        {{-- Harga Beli --}}
        <div>
            <label class="block text-sm text-gray-600 mb-1">Harga Beli</label>
            <input type="number" name="harga_beli" value="{{ old('harga_beli', $product->harga_beli) }}"
                class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 p-2" />
        </div>

        {{-- Harga Jual --}}
        <div>
            <label class="block text-sm text-gray-600 mb-1">Harga Jual</label>
            <input type="number" name="harga_jual" value="{{ old('harga_jual', $product->harga_jual) }}"
                class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 p-2" />
        </div>

        {{-- Minimal Stok --}}
        <div>
            <label class="block text-sm text-gray-600 mb-1">Minimal Stok</label>
            <input type="number" name="minimal_stok" value="{{ old('minimal_stok', $product->minimal_stok) }}"
                class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 p-2" />
        </div>

        {{-- Gambar --}}
        <div>
            <label class="block text-sm text-gray-600 mb-1">Gambar Produk (Opsional)</label>
            @if ($product->image)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image"
                         class="w-24 h-24 object-cover rounded shadow border" />
                </div>
            @endif
            <input type="file" name="image"
                class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 p-2 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200" />
        </div>

        {{-- Tombol --}}
        <div class="gap-2 flex">
            <a href="{{ route($rolePrefix . '.product.index') }}"
                class="w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition">
                Batal
            </a>
            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                Update Produk
            </button>
        </div>
    </form>
</div>
@endsection