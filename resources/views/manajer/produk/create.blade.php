@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<h1 class="text-2xl font-bold mb-4">Tambah Produk</h1>

<form action="{{ route('manajer.produk.store') }}" method="POST" class="space-y-4">
    @csrf
    <div>
        <label>Nama Produk:</label>
        <input type="text" name="nama" class="w-full border px-3 py-2" required>
    </div>
    <div>
        <label>Stok:</label>
        <input type="number" name="stock" class="w-full border px-3 py-2" required>
    </div>
    <div>
        <label>Satuan:</label>
        <input type="text" name="satuan" class="w-full border px-3 py-2" required>
    </div>
    <div>
        <label>Supplier:</label>
        <select name="supplier_id" class="w-full border px-3 py-2">
            @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->nama }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label>Kategori:</label>
        <select name="kategori_id" class="w-full border px-3 py-2">
            @foreach($kategori as $kat)
                <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
</form>
@endsection
