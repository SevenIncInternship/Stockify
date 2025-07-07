@extends('layouts.app')

@section('content')
    <div class="p-6">
        <h1 class="text-xl font-bold mb-4">Kategori Produk</h1>

        <a href="{{ route('admin.category.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded mb-4 inline-block">+ Tambah Kategori</a>

        <table class="table-auto w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2">#</th>
                    <th class="p-2">Nama</th>
                    <th class="p-2">Deskripsi</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr class="border-b">
                    <td class="p-2">{{ $loop->iteration }}</td>
                    <td class="p-2">{{ $category->nama }}</td>
                    <td class="p-2">{{ $category->deskripsi }}</td>
                    <td class="p-2">
                        <a href="{{ route('admin.category.edit', $category) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('admin.category.destroy', $category) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Hapus kategori ini?')" class="text-red-600 ml-2 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
