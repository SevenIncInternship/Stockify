@extends('layouts.app')

@section('title', 'Edit Barang Keluar')

@section('content')
<div class="p-6 bg-white rounded-xl shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Barang Keluar</h1>

    <form method="POST" action="{{ route('admin.barang_keluar.update', $item->id) }}" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Input Nama Barang --}}
        <div>
            <label for="nama_barang" class="block text-sm font-medium text-gray-700 mb-1">Nama Barang</label>
            <input
                type="text"
                name="nama_barang"
                id="nama_barang"
                value="{{ old('nama_barang', $item->nama_barang) }}"
                class="w-full px-4 py-2 border {{ $errors->has('nama_barang') ? 'border-red-500' : 'border-gray-300' }} rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                required
                placeholder="Masukkan nama barang"
            >
            @error('nama_barang')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Input Jumlah --}}
        <div>
            <label for="jumlah" class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
            <input
                type="number"
                name="jumlah"
                id="jumlah"
                value="{{ old('jumlah', $item->jumlah) }}"
                class="w-full px-4 py-2 border {{ $errors->has('jumlah') ? 'border-red-500' : 'border-gray-300' }} rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                required
                min="0"
                placeholder="Masukkan jumlah barang"
            >
            @error('jumlah')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Input Satuan --}}
        <div>
            <label for="satuan" class="block text-sm font-medium text-gray-700 mb-1">Satuan</label>
            <input
                type="text"
                name="satuan"
                id="satuan"
                value="{{ old('satuan', $item->satuan) }}"
                class="w-full px-4 py-2 border {{ $errors->has('satuan') ? 'border-red-500' : 'border-gray-300' }} rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                required
                placeholder="Contoh: pcs, kg, liter"
            >
            @error('satuan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Select Status --}}
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            @php
                $statusClass = $errors->has('status') ? 'border-red-500' : 'border-gray-300';
            @endphp
            <select
                name="status"
                id="status"
                class="w-full px-4 py-2 border {{ $statusClass }} rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                required
            >
                <option value="pending" {{ old('status', $item->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="selesai" {{ old('status', $item->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
            @error('status')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex justify-end gap-3">
            <a href="{{ route('barang_keluar.index') }}"
               class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-150 ease-in-out">
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
