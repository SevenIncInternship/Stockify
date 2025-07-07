@extends('layouts.app')

@section('title', 'Tambah Barang Masuk')

@section('content')
<div class="max-w-xl mx-auto bg-white shadow p-6 rounded">
    <h1 class="text-xl font-bold mb-4 text-gray-800">Tambah Barang Masuk</h1>

    {{-- Tampilkan pesan error jika ada --}}
    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 p-3 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <form method="POST" action="{{ route('admin.barang_masuk.store') }}">
        @csrf

        {{-- Nama Barang --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Nama Barang</label>
            <input type="text" name="nama_barang" required
                   class="w-full mt-1 p-2 border border-gray-300 rounded"
                   value="{{ old('nama_barang') }}">
        </div>

        {{-- Jumlah --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Jumlah</label>
            <input type="number" name="jumlah" required min="1"
                   class="w-full mt-1 p-2 border border-gray-300 rounded"
                   value="{{ old('jumlah') }}">
        </div>

        {{-- Satuan --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Satuan</label>
            <input type="text" name="satuan" required
                   class="w-full mt-1 p-2 border border-gray-300 rounded"
                   value="{{ old('satuan') }}">
        </div>

        {{-- Tanggal --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Tanggal</label>
            <input type="date" name="tanggal"
                   class="w-full mt-1 p-2 border border-gray-300 rounded"
                   value="{{ old('tanggal', now()->format('Y-m-d')) }}">
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end">
            <a href="{{ route('admin.barang_masuk.index') }}" class="text-gray-500 mr-4 hover:underline">Batal</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
