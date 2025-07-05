@extends('layouts.app')
@section('content')
<div class="p-6">
    <h1 class="text-xl font-bold mb-4">Tambah Produk</h1>
    <form method="POST" action="{{ route('admin.product.store') }}" class="space-y-4">
        @csrf
        <input type="text" name="nama" placeholder="Nama Produk" class="w-full border p-2" required>
        <input type="text" name="kategori" placeholder="Kategori" class="w-full border p-2">
        <input type="number" name="stok" placeholder="Stok" class="w-full border p-2" required>
        <input type="text" name="satuan" placeholder="Satuan" class="w-full border p-2" required>
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection