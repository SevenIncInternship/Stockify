@extends('layouts.app')

@section('title', 'Daftar Supplier')

@section('content')
<div class="p-6 bg-white rounded-xl shadow-md">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Supplier</h1>
        <a href="{{ route('admin.supplier.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            + Tambah Supplier
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 text-green-600 font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full table-auto border border-gray-200 rounded-lg">
            <thead class="bg-gray-100">
                <tr class="text-left text-sm font-semibold text-gray-700">
                    <th class="p-3 border">#</th>
                    <th class="p-3 border">Nama</th>
                    <th class="p-3 border">Alamat</th>
                    <th class="p-3 border">Telepon</th>
                    <th class="p-3 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suppliers as $supplier)
                <tr class="text-sm text-gray-600">
                    <td class="p-3 border">{{ $loop->iteration }}</td>
                    <td class="p-3 border">{{ $supplier->nama }}</td>
                    <td class="p-3 border">{{ $supplier->alamat }}</td>
                    <td class="p-3 border">{{ $supplier->telepon }}</td>
                    <td class="p-3 border">
                        <a href="{{ route('admin.supplier.edit', $supplier->id) }}"
                           class="text-blue-600 hover:underline mr-2">Edit</a>
                        <form action="{{ route('admin.supplier.destroy', $supplier->id) }}" method="POST" class="inline"
                              onsubmit="return confirm('Yakin ingin menghapus supplier ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center p-4 text-gray-500">Tidak ada data supplier.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
