@extends('layouts.app')
@section('content')
<div class="p-6">
    <h1 class="text-xl font-bold mb-4">Daftar Produk</h1>
    <a href="{{ route('product.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Tambah Produk</a>
    <table class="w-full mt-4 border">
        <thead><tr><th>Nama</th><th>Kategori</th><th>Stok</th><th>Satuan</th><th>Aksi</th></tr></thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->nama }}</td>
                <td>{{ $product->kategori }}</td>
                <td>{{ $product->stok }}</td>
                <td>{{ $product->satuan }}</td>
                <td>
                    <a href="{{ route('product.edit', $product->id) }}" class="text-blue-500">Edit</a>
                    <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 ml-2">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection