@extends('layouts.app')

@section('title', 'Tambah Stock Opname')

@section('content')
@php
    $role = auth()->user()->role;
    $routePrefix = $role === 'manajer' ? 'manajer' : 'staff';
@endphp


<div class="max-w-xl mx-auto bg-white shadow p-6 rounded">
    <h1 class="text-xl font-bold mb-4 text-gray-800">Tambah Stock Opname</h1>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 p-3 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

     <form method="POST" action="{{ route($rolePrefix . '.stock_opname.store') }}" class="space-y-5">
        @csrf
        <div class="mb-4">
            <label for="product_id" class="block text-sm font-medium text-gray-700">Produk</label>
            <select name="product_id" id="product_id" class="w-full mt-1 p-2 border border-gray-300 rounded" required>
                <option value="">-- Pilih Produk --</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->nama }} (Stok Sistem: {{ $product->stock }} {{ $product->satuan }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="stok_fisik" class="block text-sm font-medium text-gray-700">Stok Fisik</label>
            <input type="number" name="stok_fisik" id="stok_fisik" min="0" required
                class="w-full mt-1 p-2 border border-gray-300 rounded" value="{{ old('stok_fisik') }}">
        </div>

        <div class="mb-4">
            <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
            <textarea name="keterangan" id="keterangan" rows="3"
                class="w-full mt-1 p-2 border border-gray-300 rounded">{{ old('keterangan') }}</textarea>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('manajer.stock_opname.index') }}" class="text-gray-500 mr-4 hover:underline">Batal</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection