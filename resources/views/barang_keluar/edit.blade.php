@extends('layouts.app')

@section('title', 'Edit Barang Keluar')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit Barang Keluar</h1>

    @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-lg">
            <ul class="list-disc list-inside space-y-1 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.barang_keluar.update', $barangKeluar->id) }}" class="space-y-5">
        @csrf
        @method('PUT')

        {{-- Produk --}}
        <div>
            <label for="product_id" class="block text-sm text-gray-600 mb-1">Nama Produk</label>
            <select name="product_id" id="product_id" required
                class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none p-2">
                <option value="">-- Pilih Produk --</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ $barangKeluar->product_id == $product->id ? 'selected' : '' }}>
                        {{ $product->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Jumlah --}}
        <div>
            <label for="jumlah" class="block text-sm text-gray-600 mb-1">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" min="1" required
                value="{{ old('jumlah', $barangKeluar->jumlah) }}"
                class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none p-2" />
        </div>

        {{-- Satuan --}}
        <div>
            <label for="satuan" class="block text-sm text-gray-600 mb-1">Satuan</label>
            <select name="satuan" id="satuan" required
                class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none p-2">
                <option value="">-- Pilih Satuan --</option>
                <option value="kg" {{ old('satuan', $barangKeluar->satuan) == 'kg' ? 'selected' : '' }}>kg</option>
                <option value="pcs" {{ old('satuan', $barangKeluar->satuan) == 'pcs' ? 'selected' : '' }}>pcs</option>
                <option value="Lt" {{ old('satuan', $barangKeluar->satuan) == 'Lt' ? 'selected' : '' }}>Lt</option>
            </select>
        </div>

        {{-- Tanggal --}}
        <div>
            <label for="tanggal" class="block text-sm text-gray-600 mb-1">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal"
                value="{{ old('tanggal', $barangKeluar->tanggal->format('Y-m-d')) }}"
                class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none p-2" />
        </div>

        {{-- Status Konfirmasi --}}
        @php
            $userRole = auth()->user()->role;
            $currentStatus = old('status_konfirmasi', $barangKeluar->status_konfirmasi);
        @endphp

        @if ($userRole === 'admin' || $userRole === 'manajer')
            <div>
                <label for="status_konfirmasi" class="block text-sm text-gray-600 mb-1">Status Konfirmasi</label>
                <select name="status_konfirmasi" id="status_konfirmasi" required
                    class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none p-2">
                    <option value="pending" {{ $currentStatus == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="diterima" {{ $currentStatus == 'diterima' ? 'selected' : '' }}>Diterima</option>
                    @if ($userRole === 'admin')
                        <option value="ditolak" {{ $currentStatus == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    @endif
                </select>
            </div>
        @else
            <input type="hidden" name="status_konfirmasi" value="{{ $currentStatus }}">
        @endif

        {{-- Tombol --}}
       <div class="gap-2 flex">
            <a href="{{ route('admin.barang_keluar.index') }}"
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