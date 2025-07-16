@extends('layouts.app')

@section('title', 'Stock Opname')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Stock Opname</h1>
            <p class="text-sm text-gray-500">Catatan pemeriksaan stok fisik produk</p>
        </div>
        <a href="{{ route('manajer.stock_opname.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Tambah Stock Opname</a>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok Sistem</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok Fisik</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Selisih</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($data as $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap font-semibold text-gray-700">{{ $item->product->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->stok_sistem }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->stok_fisik }}</td>
                    <td class="px-6 py-4 whitespace-nowrap font-bold {{ $item->stok_fisik - $item->stok_sistem == 0 ? 'text-green-600' : 'text-red-600' }}">
                        {{ $item->stok_fisik - $item->stok_sistem }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap flex gap-2">
                        <a href="{{ route('manajer.stock_opname.show', $item->id) }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">Detail</a>
                        <form action="{{ route('manajer.stock_opname.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus data ini?')" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center px-6 py-4 text-gray-500">Tidak ada data stock opname.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection