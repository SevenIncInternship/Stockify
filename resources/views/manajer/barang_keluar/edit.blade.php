@extends('layouts.app')
@section('title', 'Edit Barang Keluar')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Barang Keluar</h1>

    <form method="POST" action="{{ route('manajer.barang_keluar.update', $barang_keluar->id) }}">
        @csrf
        @method('PUT')

        <label for="product_id">Produk</label>
        <select name="product_id" id="product_id" required>
            @foreach ($produk as $p)
                <option value="{{ $p->id }}" {{ $barang_keluar->product_id == $p->id ? 'selected' : '' }}>
                    {{ $p->nama }}
                </option>
            @endforeach
        </select>

        <label for="jumlah">Jumlah</label>
        <input type="number" name="jumlah" id="jumlah" min="1" value="{{ $barang_keluar->jumlah }}" required>

        <button type="submit">Update</button>
    </form>
@endsection
