@extends('layouts.app')

@section('title', 'Barang Masuk')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Barang Masuk</h1>
    <p class="mb-4">Daftar barang masuk yang telah dicatat oleh manajer.</p>
    <a href="{{ route('manajer.barang_masuk.create') }}" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">+ Tambah Barang Masuk</a>

    <table class="table-auto w-full border border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">Tanggal</th>
                <th class="border px-4 py-2">Nama Produk</th>
                <th class="border px-4 py-2">Jumlah</th>
                <th class="border px-4 py-2">Supplier</th>
            </tr>
        </thead>
        <tbody>
            @forelse($barang_masuk as $item)
                <tr>
                    <td class="border px-4 py-2">{{ optional($item->tanggal)->format('d M Y') }}</td>
                    <td class="border px-4 py-2">{{ $item->product->nama ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $item->jumlah }} {{ $item->satuan }}</td>
                    <td class="border px-4 py-2">{{ $item->supplier->nama ?? '-' }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('manajer.barang_masuk.edit', $item->id) }}" class="text-blue-500 hover:underline">Edit</a>
                        <form action="{{ route('manajer.barang_masuk.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline ml-2">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-500">Data belum tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
