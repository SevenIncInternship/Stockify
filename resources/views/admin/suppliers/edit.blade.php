@extends('layouts.app')

@section('title', 'Edit Supplier')

@section('content')
<div class="p-6 bg-white rounded-xl shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Supplier</h1>

    <form method="POST" action="{{ route('admin.supplier.update', $supplier->id) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Supplier</label>
            <input
                type="text"
                name="nama"
                id="nama"
                value="{{ old('nama', $supplier->nama) }}"
                required
                class="w-full px-4 py-2 border rounded-lg shadow-sm"
            >
            @error('nama')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
            <textarea
                name="alamat"
                id="alamat"
                rows="3"
                class="w-full px-4 py-2 border rounded-lg shadow-sm"
                required
            >{{ old('alamat', $supplier->alamat) }}</textarea>
            @error('alamat')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="telepon" class="block text-sm font-medium text-gray-700 mb-1">No Telepon</label>
            <input
                type="text"
                name="telepon"
                id="telepon"
                value="{{ old('telepon', $supplier->telepon) }}"
                required
                class="w-full px-4 py-2 border rounded-lg shadow-sm"
            >
            @error('telepon')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.supplier.index') }}"
                class="px-4 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50 mr-2">Batal</a>
            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
