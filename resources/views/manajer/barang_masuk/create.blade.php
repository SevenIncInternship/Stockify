@extends('layouts.app')
@section('title', 'Tambah Barang Masuk')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Tambah Barang Masuk</h1>

    <form method="POST" action="{{ route('manajer.barang_masuk.store') }}">
        @csrf
        <label>Produk</label>
        <select name="produk_id" required>
            @foreach ($produk as $p)
                <option value="{{ $p->id }}">{{ $p->nama }}</option>
            @endforeach
        </select>

        <label>Supplier</label>
        <select name="supplier_id" required>
            @foreach ($supplier as $s)
                <option value="{{ $s->id }}">{{ $s->nama }}</option>
            @endforeach
        </select>

        <label>Jumlah</label>
        <input type="number" name="jumlah" min="1" required>

        <button type="submit">Simpan</button>
    </form>
@endsection
