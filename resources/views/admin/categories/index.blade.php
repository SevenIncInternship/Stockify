@extends('layouts.app')

@section('title', 'Kategori Produk')

@section('content')
<div class="p-6 max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Kategori Produk</h1>
        <a href="{{ route('admin.category.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
            + Tambah Kategori
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full text-sm text-left border">
            <thead class="bg-gray-100 text-gray-700 font-semibold">
                <tr>
                    <th class="px-4 py-3 border-b w-16">#</th>
                    <th class="px-4 py-3 border-b">Nama Kategori</th>
                    <th class="px-4 py-3 border-b">Deskripsi</th>
                    <th class="px-4 py-3 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                @forelse($categories as $category)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $category->nama }}</td>
                        <td class="px-4 py-2">{{ $category->deskripsi }}</td>
                        <td class="px-4 py-2 text-center whitespace-nowrap">
                            <a href="{{ route('admin.category.edit', $category->id) }}"
                               class="text-blue-600 hover:underline mr-2">Edit</a>
                            <form action="{{ route('admin.category.destroy', $category->id) }}"
                                  method="POST"
                                  class="inline"
                                  onsubmit="return confirm('Hapus kategori ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500">Belum ada data kategori.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
