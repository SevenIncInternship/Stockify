@extends('layouts.app')

@section('title', 'Laporan Barang Keluar')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Laporan Barang Keluar</h2>

    <a href="{{ route('admin.laporan.barangKeluar.pdf') }}" class="btn btn-primary mb-4">Unduh Laporan PDF</a>

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
            @foreach($barangKeluar as $i => $keluar)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $keluar->product->nama }}</td>
                    <td>{{ $keluar->supplier->nama }}</td>
                    <td>{{ $keluar->jumlah }}</td>
                    <td>{{ $keluar->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
