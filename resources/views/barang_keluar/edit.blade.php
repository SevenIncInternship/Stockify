-- resources/views/admin/barang_keluar/edit.blade.php --
@extends('layouts.app')

@section('title', 'Edit Barang Keluar')

@section('content')
<div class="p-6 bg-white rounded-xl shadow-md max-w-xl mx-auto">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Barang Keluar</h1>

    <form method="POST" action="{{ route('admin.barang_keluar.update', $barangKeluar->id) }}" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Pilih Produk --}}
        <div>
            <label for="product_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Produk</label>
            <select name="product_id" id="product_id" required class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ $barangKeluar->product_id == $product->id ? 'selected' : '' }}>
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
            <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah', $barangKeluar->jumlah) }}" required class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('jumlah')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Satuan --}}
        <div>
            <label for="satuan" class="block text-sm font-medium text-gray-700 mb-1">Satuan</label>
            <input type="text" id="satuan" name="satuan" value="{{ old('satuan', $barangKeluar->satuan) }}" required class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('satuan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tanggal --}}
        <div>
            <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', $barangKeluar->tanggal->format('Y-m-d')) }}" required class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('tanggal')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status Konfirmasi --}}
        <div>
            <label for="status_konfirmasi" class="block text-sm font-medium text-gray-700 mb-1">Status Konfirmasi</label>
            <select name="status_konfirmasi" id="status_konfirmasi" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="pending" {{ $barangKeluar->status_konfirmasi == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="diterima" {{ $barangKeluar->status_konfirmasi == 'diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="ditolak" {{ $barangKeluar->status_konfirmasi == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
            @error('status_konfirmasi')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol Simpan --}}
        <div class="flex justify-end">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
