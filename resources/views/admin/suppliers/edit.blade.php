@extends('layouts.app')

@section('title', 'Edit Supplier')

@section('content')
<div class="w-full flex justify-center mt-10">
    <div class="w-full sm:w-[380px] bg-white p-6 rounded-2xl shadow-md border border-gray-200">
        <h1 class="text-xl font-semibold text-gray-800 mb-6 text-center">Edit Supplier</h1>

        <form method="POST" action="{{ route('admin.suppliers.update', $supplier->id) }}" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div>
                <label for="nama" class="block text-sm text-gray-600 mb-1">Nama Supplier</label>
                <input
                    type="text"
                    name="nama"
                    id="nama"
                    value="{{ old('nama', $supplier->nama) }}"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                >
                @error('nama')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Alamat --}}
            <div>
                <label for="alamat" class="block text-sm text-gray-600 mb-1">Alamat</label>
                <textarea
                    name="alamat"
                    id="alamat"
                    rows="3"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 resize-none"
                >{{ old('alamat', $supplier->alamat) }}</textarea>
                @error('alamat')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Telepon --}}
            <div>
                <label for="telepon" class="block text-sm text-gray-600 mb-1">No. Telepon</label>
                <input
                    type="text"
                    name="telepon"
                    id="telepon"
                    value="{{ old('telepon', $supplier->telepon) }}"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                >
                @error('telepon')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="gap-2 flex">
            <a href="{{ route('admin.barang_keluar.index') }}"
                class="w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition">
                Batal
            </a>
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                Update Produk
            </button>
        </div>
        </form>
    </div>
</div>
@endsection
