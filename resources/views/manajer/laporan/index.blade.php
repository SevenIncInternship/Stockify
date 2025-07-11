@extends('layouts.app')

@section('title', 'Laporan')

@section('content')
<h1 class="text-2xl font-bold mb-4">Laporan Barang</h1>
<p class="mb-4">Laporan ringkasan stok dan transaksi.</p>

<ul class="list-disc pl-5">
    <li><a href="{{ route('manajer.laporan.index') }}?jenis=stok">Laporan Stok Barang</a></li>
    <li><a href="{{ route('manajer.laporan.index') }}?jenis=masuk">Laporan Barang Masuk</a></li>
    <li><a href="{{ route('manajer.laporan.index') }}?jenis=keluar">Laporan Barang Keluar</a></li>
</ul>
@endsection