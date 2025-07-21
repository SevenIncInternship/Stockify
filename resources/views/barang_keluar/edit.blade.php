@extends('layouts.app')

@section('title', 'Edit Barang Keluar')

@section('content')
<div class="max-w-xl mx-auto bg-white shadow p-6 rounded">
    <h1 class="text-xl font-bold mb-4 text-gray-800">Edit Barang Keluar</h1>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 p-3 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.barang_keluar.update', $barangKeluar->id) }}">
        @csrf
        @method('PUT')

        {{-- Produk --}}
        <div class="mb-4">
            <label for="product_id" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
            <select name="product_id" id="product_id" class="w-full p-2 border border-gray-300 rounded" required>
                <option value="">-- Pilih Produk --</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ $barangKeluar->product_id == $product->id ? 'selected' : '' }}>
                        {{ $product->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Jumlah --}}
        <div class="mb-4">
            <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" min="1" required
                   class="w-full mt-1 p-2 border border-gray-300 rounded"
                   value="{{ old('jumlah', $barangKeluar->jumlah) }}">
        </div>

        {{-- Satuan --}}
        <div class="mb-4">
            <label for="satuan" class="block text-sm font-medium text-gray-700">Satuan</label>
            <select name="satuan" id="satuan" required class="w-full mt-1 p-2 border border-gray-300 rounded">
                <option value="">-- Pilih Satuan --</option>
                <option value="kg" {{ old('satuan', $barangKeluar->satuan) == 'kg' ? 'selected' : '' }}>kg</option>
                <option value="pcs" {{ old('satuan', $barangKeluar->satuan) == 'pcs' ? 'selected' : '' }}>pcs</option>
                <option value="Lt" {{ old('satuan', $barangKeluar->satuan) == 'Lt' ? 'selected' : '' }}>Lt</option>
            </select>
        </div>

        {{-- Tanggal --}}
        <div class="mb-4">
            <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal"
                   class="w-full mt-1 p-2 border border-gray-300 rounded"
                   value="{{ old('tanggal', $barangKeluar->tanggal->format('Y-m-d')) }}">
        </div>

        {{-- Status Konfirmasi --}}
        @php
            $userRole = auth()->user()->role;
            $currentStatus = old('status_konfirmasi', $barangKeluar->status_konfirmasi);
        @endphp

        @if ($userRole === 'admin')
            <div class="mb-4">
                <label for="status_konfirmasi" class="block text-sm font-medium text-gray-700">Status Konfirmasi</label>
                <select name="status_konfirmasi" id="status_konfirmasi" required class="w-full mt-1 p-2 border border-gray-300 rounded">
                    <option value="pending" {{ $currentStatus == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="diterima" {{ $currentStatus == 'diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="ditolak" {{ $currentStatus == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
        @elseif ($userRole === 'manajer')
            <div class="mb-4">
                <label for="status_konfirmasi" class="block text-sm font-medium text-gray-700">Status Konfirmasi</label>
                <select name="status_konfirmasi" id="status_konfirmasi" required class="w-full mt-1 p-2 border border-gray-300 rounded">
                    <option value="pending" {{ $currentStatus == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="diterima" {{ $currentStatus == 'diterima' ? 'selected' : '' }}>Diterima</option>
                </select>
            </div>
        @else
            <input type="hidden" name="status_konfirmasi" value="{{ $currentStatus }}">
        @endif

        {{-- Tombol --}}
        <div class="flex justify-end mt-4">
            <a href="{{ route('admin.barang_keluar.index') }}" class="text-gray-500 mr-4 hover:underline">Batal</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Update</button>
        </div>
    </form>
</div>
@endsection