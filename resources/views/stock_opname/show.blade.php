@extends('layouts.app')

@section('title', 'Detail Stock Opname')

@section('content')
@php
    $role = auth()->user()->role;
    $routePrefix = $role === 'manajer' ? 'manajer' : 'staff';
@endphp
<div class="max-w-2xl mx-auto mt-8">
    <div class="bg-white rounded-2xl shadow-sm p-6 space-y-6 border border-gray-200">
        <div class="space-y-1">
            <h1 class="text-xl font-semibold text-gray-800">Detail Stock Opname</h1>
            <p class="text-sm text-gray-500">Informasi lengkap dari hasil stock opname</p>
        </div>

        <div class="divide-y divide-gray-200">
            <div class="py-4">
                <p class="text-sm text-gray-500">Nama Produk</p>
                <p class="text-base text-gray-800 font-medium">{{ $stockOpname->product->nama ?? '—' }}</p>
            </div>
            <div class="py-4">
                <p class="text-sm text-gray-500">SKU Produk</p>
                <p class="text-base text-gray-800">{{ $stockOpname->product->SKU ?? '—' }}</p>
            </div>
            <div class="py-4">
                <p class="text-sm text-gray-500">Stok Sistem</p>
                <p class="text-base text-gray-800">{{ $stockOpname->stok_sistem }}</p>
            </div>
            <div class="py-4">
                <p class="text-sm text-gray-500">Stok Fisik</p>
                <p class="text-base text-gray-800">{{ $stockOpname->stok_fisik }}</p>
            </div>
            <div class="py-4">
                <p class="text-sm text-gray-500">Selisih</p>
                <p class="text-base text-gray-800 font-semibold text-red-600">
                    {{ $stockOpname->stok_fisik - $stockOpname->stok_sistem }}
                </p>
            </div>
            <div class="py-4">
                <p class="text-sm text-gray-500">Tanggal Opname</p>
                <p class="text-base text-gray-800">{{ \Carbon\Carbon::parse($stockOpname->tanggal)->format('d M Y') }}</p>
            </div>
            <div class="py-4">
                <p class="text-sm text-gray-500">Keterangan</p>
                <p class="text-base text-gray-800">{{ $stockOpname->keterangan ?? '—' }}</p>
            </div>
        </div>

        <div class="pt-4">
            <a href="{{ route($routePrefix . '.stock_opname.index') }}"
               class="inline-block px-4 py-2 text-sm bg-yellow-300 text-gray-700 rounded-lg hover:bg-yellow-400 transition">
                ← Kembali ke Daftar
            </a>
        </div>
    </div>
</div>
@endsection
