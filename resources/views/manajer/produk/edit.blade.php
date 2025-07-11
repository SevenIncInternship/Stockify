@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Produk</h1>

<form action="{{ route('manajer.produk.update', $produk->id) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label for="nama" class="block font-medium">Nama Produk</label>
        <input type="text" name="nama" id="nama" value="{{ $produk->nama }}" required
            class="w-full border-gray-300 rounded-md shadow-sm">
    </div>

    <div>
        <label for="category_id" class="block font-medium">Kategori</label>
        <select name="category_id" id="category_id" class="w-full border-gray-300 rounded-md shadow-sm" required>
            @foreach($kategori as $kat)
                <option value="{{ $kat->id }}" {{ $produk->category_id == $kat->id ? 'selected' : '' }}>
                    {{ $kat->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="supplier_id" class="block font-medium">Supplier</label>
        <select name="supplier_id" id="supplier_id" class="w-full border-gray-300 rounded-md shadow-sm" required>
            @foreach($suppliers as $sup)
                <option value="{{ $sup->id }}" {{ $produk->supplier_id == $sup->id ? 'selected' : '' }}>
                    {{ $sup->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="stock" class="block font-medium">Stok</label>
        <input type="number" name="stock" id="stock" value="{{ $produk->stock }}" required
            class="w-full border-gray-300 rounded-md shadow-sm">
    </div>

    <div>
        <label for="satuan" class="block font-medium">Satuan</label>
        <input type="text" name="satuan" id="satuan" value="{{ $produk->satuan }}" required
            class="w-full border-gray-300 rounded-md shadow-sm">
    </div>

    <div>
        <button type="submit"
            class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">
            Update Produk
        </button>
        <a href="{{ route('manajer.produk.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
    </div>
</form>
@endsection
