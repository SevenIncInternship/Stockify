@extends('layouts.app')

@section('title', 'Tambah Supplier')

@section('content')
<div class="p-6 bg-white rounded-xl shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Tambah Supplier</h1>

    <form method="POST" action="{{ route('admin.supplier.store') }}" class="space-y-6">
        @csrf

        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Supplier</label>
            <input type="text" id="nama" name="nama"
                   value="{{ old('nama') }}"
                   required
                   class="w-full px-4 py-2 border rounded-lg shadow-sm">
            @error('nama')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
            <textarea id="alamat" name="alamat"
                      rows="3"
                      required
                      class="w-full px-4 py-2 border rounded-lg shadow-sm">{{ old('alamat') }}</textarea>
            @error('alamat')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="telepon" class="block text-sm font-medium text-gray-700 mb-1">No Telepon</label>
            <input type="text" id="telepon" name="telepon"
                   value="{{ old('telepon') }}"
                   required
                   class="w-full px-4 py-2 border rounded-lg shadow-sm">
            @error('telepon')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.supplier.index') }}"
               class="px-4 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50 mr-2">Batal</a>
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700">
                Simpan Supplier
            </button>
        </div>
    </form>
</div>
@endsection
