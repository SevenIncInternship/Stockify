@extends('layouts.app')
@section('title', 'Edit Barang Masuk')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Barang Masuk</h1>

@if (session('success'))
    <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{ route('manajer.barang_masuk.update', $barang_masuk->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="product_id" class="block font-semibold">Produk</label>
        <select name="product_id" id="product_id" class="w-full border border-gray-300 rounded px-3 py-2">
            @foreach($produk as $p)
                <option value="{{ $p->id }}" {{ $barang_masuk->product_id == $p->id ? 'selected' : '' }}>
                    {{ $p->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label for="supplier_id" class="block font-semibold">Supplier</label>
        <select name="supplier_id" id="supplier_id" class="w-full border border-gray-300 rounded px-3 py-2">
            @foreach($supplier as $s)
                <option value="{{ $s->id }}" {{ $barang_masuk->supplier_id == $s->id ? 'selected' : '' }}>
                    {{ $s->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label for="jumlah" class="block font-semibold">Jumlah</label>
        <input type="number" name="jumlah" id="jumlah" value="{{ $barang_masuk->jumlah }}"
            class="w-full border border-gray-300 rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label for="satuan" class="block font-semibold">Satuan</label>
        <input type="text" name="satuan" id="satuan" value="{{ $barang_masuk->satuan }}"
            class="w-full border border-gray-300 rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label for="tanggal" class="block font-semibold">Tanggal</label>
        <input type="date" name="tanggal" id="tanggal" value="{{ $barang_masuk->tanggal->format('Y-m-d') }}"
            class="w-full border border-gray-300 rounded px-3 py-2" required>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
</form>
@endsection
