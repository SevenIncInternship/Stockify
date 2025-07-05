@extends('layouts.app')

@section('title', 'Daftar Barang Keluar')

@section('content')
<div class="p-6 max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Barang Keluar</h1>
        <a href="{{ route('admin.barang-keluar.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition">
            + Tambah Barang Keluar
        </a>
    </div>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full text-sm text-left border border-gray-200">
            <thead class="bg-gray-100 text-gray-700 font-semibold">
                <tr>
                    <th class="px-4 py-3 border-b">Nama Barang</th>
                    <th class="px-4 py-3 border-b">Jumlah</th>
                    <th class="px-4 py-3 border-b">Satuan</th>
                    <th class="px-4 py-3 border-b">Status</th>
                    <th class="px-4 py-3 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                @forelse($items as $item)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $item->nama_barang }}</td>
                        <td class="px-4 py-2">{{ $item->jumlah }}</td>
                        <td class="px-4 py-2">{{ $item->satuan }}</td>
                        <td class="px-4 py-2 capitalize">
                            @if ($item->status === 'pending')
                                <span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded">Pending</span>
                            @else
                                <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded">Selesai</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 text-center whitespace-nowrap">
                            <a href="{{ route('admin.barang-keluar.edit', $item->id) }}"
                               class="text-blue-600 hover:underline mr-3">Edit</a>
                            <form action="{{ route('admin.barang-keluar.destroy', $item->id) }}"
                                  method="POST"
                                  class="inline"
                                  onsubmit="return confirm('Yakin ingin menghapus item ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-500">Tidak ada data barang keluar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
