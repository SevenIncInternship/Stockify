@extends('layouts.app')

@section('title', 'Tambah Barang Keluar')

@section('content')
<div class="p-6 bg-white rounded-xl shadow-md max-w-xl mx-auto">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Tambah Barang Keluar</h1>

    <form method="POST" action="{{ route('admin.barang_keluar.store') }}" class="space-y-6">
        @csrf

        {{-- Pilih Produk --}}
        <div>
            <label for="product_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Produk</label>
            <select name="product_id" id="product_id" required class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 {{ $errors->has('product_id') ? 'border-red-500' : 'border-gray-300' }}">
                <option value="">-- Pilih Produk --</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
            @error('product_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Jumlah --}}
        <div>
            <label for="jumlah" class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
            <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah') }}" placeholder="Masukkan jumlah" required class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 {{ $errors->has('jumlah') ? 'border-red-500' : 'border-gray-300' }}">
            @error('jumlah')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Satuan --}}
        <div>
            <label for="satuan" class="block text-sm font-medium text-gray-700 mb-1">Satuan</label>
            <input type="text" id="satuan" name="satuan" value="{{ old('satuan') }}" placeholder="Contoh: pcs, kg, liter" required class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 {{ $errors->has('satuan') ? 'border-red-500' : 'border-gray-300' }}">
            @error('satuan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tanggal --}}
        <div>
            <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', now()->format('Y-m-d')) }}" required class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 {{ $errors->has('tanggal') ? 'border-red-500' : 'border-gray-300' }}">
            @error('tanggal')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol Simpan --}}
        <div class="flex justify-end">
            <button type="submit" class="px-6 py-2 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection