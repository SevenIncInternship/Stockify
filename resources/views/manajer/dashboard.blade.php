@extends('layouts.app')
@section('title', 'Dashboard Manajer')
@section('content')
<div class="space-y-6">
    <div class="bg-white p-4 shadow rounded">
        <h2 class="text-xl font-bold mb-2">Statistik Stok Barang</h2>
        <p>Total Produk: <strong>{{ $totalProduk }}</strong></p>
        <p>Total Barang Masuk: <strong>{{ $totalMasuk }}</strong></p>
        <p>Total Barang Keluar: <strong>{{ $totalKeluar }}</strong></p>
    </div>
</div>
@endsection
