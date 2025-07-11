@extends('layouts.app')

@section('title', 'Supplier')

@section('content')
<h1 class="text-2xl font-bold mb-4">Data Supplier</h1>
<p class="mb-4">Daftar supplier yang terdaftar.</p>

<table class="table-auto w-full border-collapse border border-gray-300">
    <thead>
        <tr class="bg-gray-100">
            <th class="border px-4 py-2">Nama</th>
            <th class="border px-4 py-2">Kontak</th>
            <th class="border px-4 py-2">Alamat</th>
        </tr>
    </thead>
    <tbody>
        @forelse($supplier as $item)
        <tr>
            <td class="border px-4 py-2">{{ $item->nama }}</td>
            <td class="border px-4 py-2">{{ $item->telepon ?? '-' }}</td>
            <td class="border px-4 py-2">{{ $item->alamat ?? '-' }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center text-gray-500 py-4">Tidak ada supplier ditemukan.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
