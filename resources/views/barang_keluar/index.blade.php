@extends('layouts.app')

@section('title', 'Data Barang Keluar')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold text-gray-800">Barang Keluar</h1>
        <a href="{{ route('admin.barang_keluar.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            <i class="fas fa-plus mr-1"></i> Tambah Barang Keluar
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg shadow">
            <thead>
                <tr class="bg-gray-100 text-gray-700 text-left">
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Nama Barang</th>
                    <th class="px-4 py-2">Jumlah</th>
                    <th class="px-4 py-2">Satuan</th>
                    <th class="px-4 py-2">Tanggal</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($barangKeluar as $index => $barang)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $barangKeluar->firstItem() + $index }}</td>
                        <td class="px-4 py-2 font-medium text-gray-800">
                            {{ $barang->product?->nama ?? '-' }}
                        </td>
                        <td class="px-4 py-2">{{ $barang->jumlah }}</td>
                        <td class="px-4 py-2">{{ $barang->satuan }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($barang->tanggal)->format('d-m-Y') }}</td>
                        <td class="px-4 py-2">
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded 
                                {{ 
                                    $barang->status_konfirmasi === 'diterima' ? 'bg-green-200 text-green-700' :
                                    ($barang->status_konfirmasi === 'ditolak' ? 'bg-red-200 text-red-700' :
                                    'bg-yellow-200 text-yellow-800')
                                }}">
                                {{ ucfirst($barang->status_konfirmasi) }}
                            </span>
                        </td>
                        <td class="px-4 py-2">
                            @if($barang->status_konfirmasi === 'pending')
                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('admin.barang_keluar.edit', $barang->id) }}" class="text-blue-600 hover:underline">
                                        <i class="fas fa-edit mr-1"></i>Edit
                                    </a>
                                    <form action="{{ route('admin.barang_keluar.destroy', $barang->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">
                                            <i class="fas fa-trash mr-1"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            @else
                                <span class="text-gray-400 text-xs italic">Tidak bisa diubah</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-gray-500">Belum ada data barang keluar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($barangKeluar->hasPages())
        <div class="mt-4">
            {{ $barangKeluar->links() }}
        </div>
    @endif
</div>
@endsection