@extends('layouts.app')

@section('title', 'Edit Barang Keluar')

@section('content')
<div class="p-6 bg-white rounded-xl shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Barang Keluar</h1>

    <form method="POST" action="{{ route('admin.barang-keluar.update', $item->id) }}" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Nama Barang --}}
        <div>
            <label for="nama_barang" class="block text-sm font-medium text-gray-700 mb-1">Nama Barang</label>
            <input
                type="text"
                id="nama_barang"
                name="nama_barang"
                value="{{ old('nama_barang', $item->nama_barang) }}"
                placeholder="Masukkan nama barang"
                required
                class="w-full px-4 py-2 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 border {{ $errors->has('nama_barang') ? 'border-red-500' : 'border-gray-300' }}"
            >
            @error('nama_barang')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Jumlah --}}
        <div>
            <label for="jumlah" class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
            <input
                type="number"
                id="jumlah"
                name="jumlah"
                value="{{ old('jumlah', $item->jumlah) }}"
                min="0"
                placeholder="Masukkan jumlah barang"
                required
                class="w-full px-4 py-2 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 border {{ $errors->has('jumlah') ? 'border-red-500' : 'border-gray-300' }}"
            >
            @error('jumlah')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Satuan --}}
        <div>
            <label for="satuan" class="block text-sm font-medium text-gray-700 mb-1">Satuan</label>
            <input
                type="text"
                id="satuan"
                name="satuan"
                value="{{ old('satuan', $item->satuan) }}"
                placeholder="Contoh: pcs, kg, liter"
                required
                class="w-full px-4 py-2 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 border {{ $errors->has('satuan') ? 'border-red-500' : 'border-gray-300' }}"
            >
            @error('satuan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status --}}
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select
                id="status"
                name="status"
                required
                class="w-full px-4 py-2 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 border {{ $errors->has('status') ? 'border-red-500' : 'border-gray-300' }}"
            >
                <option value="pending" {{ old('status', $item->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="selesai" {{ old('status', $item->status) === 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
            @error('status')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end gap-3">
            <a
                href="{{ route('admin.barang-keluar.index') }}"
                class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-150 ease-in-out"
            >
                Batal
            </a>
            <button
                type="submit"
                class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out"
            >
                Update Barang Keluar
            </button>
        </div>
    </form>
</div>
@endsection
