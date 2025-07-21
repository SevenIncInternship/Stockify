@extends('layouts.app')

@section('title', 'Laporan Stok Barang')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Laporan Stok Barang</h2>

    <a href="{{ route('admin.laporan.stok.pdf') }}" class="btn btn-primary mb-4">Unduh Laporan PDF</a>

    <table class="table-auto w-full">
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $i => $product)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $product->nama }}</td>
                    <td>{{ $product->category->nama ?? 'N/A' }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->satuan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
