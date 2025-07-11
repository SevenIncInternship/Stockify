@extends('layouts.app')

@section('title', 'Barang Keluar')

@section('content')
<h1 class="text-2xl font-bold mb-4">Barang Keluar</h1>
<p class="mb-4">Daftar barang keluar oleh manajer gudang.</p>
<a href="{{ route('manajer.barang_keluar.create') }}" class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">+ Tambah Barang Keluar</a>

<table class="table-auto w-full border-collapse border border-gray-300">
    <thead>
        <tr class="bg-gray-100">
            <th class="border px-4 py-2">Tanggal</th>
            <th class="border px-4 py-2">Nama Produk</th>
            <th class="border px-4 py-2">Jumlah</th>
            <th class="border px-4 py-2">Status</th>
            <th class="border px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($barang_keluar as $item)
        <tr>
            <td class="border px-4 py-2">{{ $item->tanggal->format('d M Y') }}</td>
            <td class="border px-4 py-2">{{ $item->produk->nama }}</td>
            <td class="border px-4 py-2">{{ $item->jumlah }}</td>
            <td class="border px-4 py-2">{{ $item->status_konfirmasi ? 'Terkonfirmasi' : 'Menunggu' }}</td>
            <td class="border px-4 py-2">
                <a href="{{ route('manajer.barang_keluar.edit', $item->id) }}" class="text-blue-500 hover:underline">Edit</a>
                <form action="{{ route('manajer.barang_keluar.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:underline ml-2">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
