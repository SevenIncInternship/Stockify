@extends('layouts.app')

@section('content')
    <div class="p-6">
        <h1 class="text-xl font-bold mb-4">Tambah Kategori</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.category.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block font-semibold">Nama Kategori</label>
                <input type="text" name="nama" class="w-full border p-2 rounded" value="{{ old('nama') }}" required>
                @error('nama') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Deskripsi (Opsional)</label>
                <textarea name="deskripsi" class="w-full border p-2 rounded">{{ old('deskripsi') }}</textarea>
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Simpan
            </button>
            <a href="{{ route('admin.category.index') }}" class="ml-3 text-gray-600 hover:underline">Kembali</a>
        </form>
    </div>
@endsection
