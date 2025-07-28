@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
<div class="w-full flex justify-center mt-10">
    <div class="w-full sm:w-[360px] bg-white p-6 rounded-2xl shadow-md border border-gray-200">
        <h1 class="text-xl font-semibold text-gray-800 mb-6 text-center">Edit Kategori</h1>

        <form method="POST" action="{{ route('admin.category.update', $category) }}" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Nama Kategori --}}
            <div>
                <label class="block text-sm text-gray-600 mb-1">Nama Kategori</label>
                <input type="text" name="nama"
                       value="{{ old('nama', $category->nama) }}"
                       class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 p-2"
                       required>
                @error('nama')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block text-sm text-gray-600 mb-1">Deskripsi (Opsional)</label>
                <textarea name="deskripsi" rows="3"
                          class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 p-2 resize-none">{{ old('deskripsi', $category->deskripsi) }}</textarea>
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