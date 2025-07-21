@extends('layouts.app')

@section('title', 'Daftar Supplier')

@section('content')
<div class="p-6 max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Supplier</h1>
        <a href="{{ route('admin.suppliers.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
            + Tambah Supplier
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full table-auto border text-sm text-left">
            <thead class="bg-gray-100 text-gray-700 font-semibold">
                <tr>
                    <th class="px-4 py-3 border-b">#</th>
                    <th class="px-4 py-3 border-b">Nama Supplier</th>
                    <th class="px-4 py-3 border-b">Alamat</th>
                    <th class="px-4 py-3 border-b">Telepon</th>
                    <th class="px-4 py-3 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                @forelse($suppliers as $supplier)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $supplier->nama }}</td>
                        <td class="px-4 py-2">{{ $supplier->alamat }}</td>
                        <td class="px-4 py-2">{{ $supplier->telepon }}</td>
                        <td class="px-4 py-2 text-center whitespace-nowrap">
                            <a href="{{ route('admin.suppliers.edit', $supplier->id) }}"
                               class="text-blue-600 hover:underline mr-2">Edit</a>
                            <form action="{{ route('admin.suppliers.destroy', $supplier->id) }}"
                                  method="POST" class="inline"
                                  onsubmit="return confirm('Yakin ingin menghapus supplier ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">Belum ada data supplier.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection