@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard Staff Gudang</h1>

    <h2>Barang Masuk (Pending)</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangMasukPending as $bm)
                <tr>
                    <td>{{ $bm->product->nama ?? '-' }}</td>
                    <td>{{ $bm->jumlah }} {{ $bm->product->satuan ?? '' }}</td>
                    <td>{{ $bm->status_konfirmasi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Barang Keluar (Pending)</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barangKeluarPending as $bk)
                <tr>
                    <td>{{ $bk->product->nama ?? '-' }}</td>
                    <td>{{ $bk->jumlah }} {{ $bk->product->satuan ?? '' }}</td>
                    <td>{{ $bk->status_konfirmasi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
