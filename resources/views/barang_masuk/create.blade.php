@extends('layouts.app')

@section('title', 'Tambah Barang Masuk')

@section('content')
<div class="p-6 max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Tambah Barang Masuk</h1>

    <form method="POST" action="{{ route('admin.barang_masuk.store') }}" class="bg-white p-6 rounded-lg shadow space-y-4">
        @csrf

        {{-- Nama Barang --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Barang</label>
            <input type="text" name="nama_barang" placeholder="Masukkan nama barang"
                   value="{{ old('nama_barang') }}"
                   class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-green-400"
                   required>
        </div>

        {{-- Jumlah --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
            <input type="number" name="jumlah" placeholder="Masukkan jumlah"
                   value="{{ old('jumlah') }}"
                   class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-green-400"
                   required>
        </div>

        {{-- Satuan --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Satuan</label>
            <input type="text" name="satuan" placeholder="Masukkan satuan (kg, liter, pcs, dll)"
                   value="{{ old('satuan') }}"
                   class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-green-400"
                   required>
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end">
            <a href="{{ route('admin.barang_masuk.index') }}" class="mr-4 text-gray-600 hover:underline">Batal</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
