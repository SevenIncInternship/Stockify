@extends('layouts.app')

@section('title', 'Data Barang Keluar')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Barang Keluar</h1>
        <a href="{{ route('admin.barang_keluar.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            <i class="fas fa-plus mr-1"></i> Tambah Barang Keluar
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Nama Barang</th>
                    <th class="px-4 py-2">Jumlah</th>
                    <th class="px-4 py-2">Satuan</th>
                    <th class="px-4 py-2">Tanggal</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-600">
                @forelse ($barangKeluar as $index => $barang)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $barangKeluar->firstItem() + $index }}</td>
                        <td class="px-4 py-2">{{ $barang->product->name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $barang->jumlah }}</td>
                        <td class="px-4 py-2">{{ $barang->satuan }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($barang->tanggal)->format('d-m-Y') }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 rounded text-xs font-medium
                                {{ match($barang->status_konfirmasi) {
                                    'diterima' => 'bg-green-100 text-green-700',
                                    'ditolak' => 'bg-red-100 text-red-700',
                                    default => 'bg-yellow-100 text-yellow-800'
                                } }}">
                                {{ ucfirst($barang->status_konfirmasi) }}
                            </span>
                        </td>
                        <td class="px-4 py-2">
                            @if($barang->status_konfirmasi === 'pending')
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.barang_keluar.edit', $barang->id) }}" class="text-blue-600 hover:underline">
                                        <i class="fas fa-edit mr-1"></i>Edit
                                    </a>
                                    <form action="{{ route('admin.barang_keluar.destroy', $barang->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')" class="inline">
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

    @if ($barangKeluar instanceof \Illuminate\Pagination\LengthAwarePaginator && $barangKeluar->hasPages())
        <div class="mt-6">
            {{ $barangKeluar->links() }}
        </div>
    @endif
</div>
@endsection
