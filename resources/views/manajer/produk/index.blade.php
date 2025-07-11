@extends('layouts.app')

@section('title', 'Produk')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Data Produk</h1>
    <a href="{{ route('manajer.produk.create') }}" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">+ Tambah Produk</a>


    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">Nama</th>
                <th class="border px-4 py-2">Kategori</th>
                <th class="border px-4 py-2">Supplier</th>
                <th class="border px-4 py-2">Stok</th>
                <th class="border px-4 py-2">Satuan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($produk as $item)
                <tr>
                    
                    <td class="border px-4 py-2">{{ $item->nama }}</td>
                    <td class="border px-4 py-2">{{ optional($item->category)->nama ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ optional($item->supplier)->nama ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $item->stock }}</td>
                    <td class="border px-4 py-2">{{ $item->satuan }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('manajer.produk.edit', $item->id) }}" class="text-blue-500 hover:underline">Edit</a>
                        <form action="{{ route('manajer.produk.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline ml-2">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-gray-500 py-4">Tidak ada data produk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection