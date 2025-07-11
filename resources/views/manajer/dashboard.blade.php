@extends('layouts.app')

@section('title', 'Dashboard Manajer')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <h2 class="text-lg font-bold text-gray-700">Barang Masuk Hari Ini</h2>
            <p class="text-3xl mt-2 text-green-600">{{ $masukHariIni }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <h2 class="text-lg font-bold text-gray-700">Barang Keluar Hari Ini</h2>
            <p class="text-3xl mt-2 text-red-600">{{ $keluarHariIni }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <h2 class="text-lg font-bold text-gray-700">Total Produk</h2>
            <p class="text-3xl mt-2 text-blue-600">{{ $totalProduk }}</p>
        </div>
    </div>
@endsection
