@extends('layouts.app')

@section('title', 'Laporan Barang Masuk')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Laporan Barang Masuk</h2>

    <a href="{{ route('admin.laporan.barangMasuk.pdf') }}" class="btn btn-primary mb-4">Unduh Laporan PDF</a>

    <table class="table-auto w-full">
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Supplier</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barangMasuk as $i => $bm)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $bm->product->nama }}</td>
                    <td>{{ $bm->supplier->nama }}</td>
                    <td>{{ $bm->jumlah }}</td>
                    <td>{{ $bm->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
