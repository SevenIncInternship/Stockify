@extends('layouts.app')

@section('content')
    <div class="p-6">
        <h1 class="text-xl font-bold mb-4">Edit Kategori</h1>

        <form method="POST" action="{{ route('admin.category.update', $category) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-semibold">Nama Kategori</label>
                <input type="text" name="nama" class="w-full border p-2 rounded"
                       value="{{ old('nama', $category->nama) }}" required>
                @error('nama') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Deskripsi (Opsional)</label>
                <textarea name="deskripsi" class="w-full border p-2 rounded">{{ old('deskripsi', $category->deskripsi) }}</textarea>
            </div>

            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                Perbarui
            </button>
            <a href="{{ route('admin.category.index') }}" class="ml-3 text-gray-600 hover:underline">Batal</a>
        </form>
    </div>
@endsection
