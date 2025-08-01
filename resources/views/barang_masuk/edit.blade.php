@php
    $rolePrefix = auth()->user()->role;
@endphp

@extends('layouts.app')

@section('title', 'Edit Barang Masuk')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
    <h1 class="text-xl font-bold mb-4 text-gray-800">Edit Barang Masuk</h1>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 p-3 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route($rolePrefix . '.barang_masuk.update', $barangMasuk->id) }}">
        @csrf
        @method('PUT')

        {{-- Produk --}}
        <div class="mb-4">
            <label for="product_id" class="block text-sm font-medium text-gray-700">Produk</label>
            <select name="product_id" id="product_id" required
                    class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none p-2">
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id', $barangMasuk->product_id) == $product->id ? 'selected' : '' }}>
                        {{ $product->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Supplier --}}
        <div class="mb-4">
            <label for="supplier_id" class="block text-sm font-medium text-gray-700">Supplier</label>
            <select name="supplier_id" id="supplier_id" required
                class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none p-2">
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ old('supplier_id', $barangMasuk->supplier_id) == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Jumlah --}}
        <div class="mb-4">
            <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" min="1"
                value="{{ old('jumlah', $barangMasuk->jumlah) }}" required
                class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none p-2">
        </div>

        {{-- Satuan --}}
        <div class="mb-4">
            <label for="satuan" class="block text-sm font-medium text-gray-700">Satuan</label>
            <select name="satuan" id="satuan" required
                class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none p-2">
                <option value="kg" {{ old('satuan', $barangMasuk->satuan) == 'kg' ? 'selected' : '' }}>kg</option>
                <option value="pcs" {{ old('satuan', $barangMasuk->satuan) == 'pcs' ? 'selected' : '' }}>pcs</option>
                <option value="Lt" {{ old('satuan', $barangMasuk->satuan) == 'Lt' ? 'selected' : '' }}>Lt</option>
            </select>
        </div>

        {{-- Tanggal dan Jam --}}
        <div class="mb-4">
            <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal dan Jam</label>
            <input type="datetime-local" name="tanggal" id="tanggal"
            value="{{ $tanggalValue }}" required
                class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none p-2">
        </div>


        {{-- Status --}}
        <div class="mb-4">
            <label for="status_konfirmasi" class="block text-sm font-medium text-gray-700">Status Konfirmasi</label>
            <select name="status_konfirmasi" id="status_konfirmasi" required
                class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none p-2">

                <option value="pending" {{ old('status_konfirmasi', $barangMasuk->status_konfirmasi) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="diterima" {{ old('status_konfirmasi', $barangMasuk->status_konfirmasi) == 'diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="ditolak" {{ old('status_konfirmasi', $barangMasuk->status_konfirmasi) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>

        {{-- Tombol --}}
        <div class="gap-2 flex">
            <a href="{{ route($rolePrefix . '.barang_masuk.index') }}"
                class="w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition">
                Batal
            </a>
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection