@extends('layouts.app')

@section('title', 'Daftar Supplier')

@section('content')
<div class="container max-w-screen-xl mx-auto p-6">

    {{-- Notifikasi sukses --}}
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Daftar Supplier</h1>
            <p class="text-sm text-gray-500">Kelola data supplier yang tersedia</p>
        </div>
        <a href="{{ route('admin.suppliers.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow text-sm">
            Tambah Supplier
        </a>
    </div>

    {{-- Tabel --}}
    <div class="overflow-x-auto bg-white rounded shadow border border-gray-200">
        <table class="min-w-full table-auto text-sm text-gray-700">
            <thead class="bg-gray-50 text-xs font-semibold uppercase text-gray-600">
                <tr>
                    <th class="px-6 py-3 text-left">No</th>
                    <th class="px-6 py-3 text-left">Nama</th>
                    <th class="px-6 py-3 text-left">Alamat</th>
                    <th class="px-6 py-3 text-left">Telepon</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($suppliers as $supplier)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">{{ $supplier->nama }}</td>
                        <td class="px-6 py-4">{{ $supplier->alamat }}</td>
                        <td class="px-6 py-4">{{ $supplier->telepon }}</td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            <div class="flex gap-3 justify-center items-center">
                                <a href="{{ route('admin.suppliers.edit', $supplier->id) }}"
                                   class="text-indigo-600 hover:text-indigo-900 text-sm">Edit</a>
                                <form action="{{ route('admin.suppliers.destroy', $supplier->id) }}"
                                      method="POST" onsubmit="return confirm('Yakin ingin menghapus supplier ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center px-6 py-4 text-gray-500">
                            Belum ada data supplier.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection