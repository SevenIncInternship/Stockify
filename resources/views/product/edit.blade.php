@extends('layouts.app')
@section('content')
<div class="p-6">
    <h1 class="text-xl font-bold mb-4">Edit Produk</h1>
    <form method="POST" action="{{ route('admin.product.update', $product->id) }}" class="space-y-4">
        @csrf @method('PUT')
        <input type="text" name="nama" value="{{ $product->nama }}" class="w-full border p-2" required>
        <input type="text" name="kategori" value="{{ $product->kategori }}" class="w-full border p-2">
        <input type="number" name="stok" value="{{ $product->stok }}" class="w-full border p-2" required>
        <input type="text" name="satuan" value="{{ $product->satuan }}" class="w-full border p-2" required>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection