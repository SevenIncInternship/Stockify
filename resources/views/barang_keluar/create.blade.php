@extends('layouts.app')

@section('title', 'Tambah Barang Keluar')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="bg-white shadow-sm rounded-2xl p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Tambah Barang Keluar</h2>

        <form method="POST" action="{{ route($rolePrefix . '.barang_keluar.store') }}" class="space-y-5">
            @csrf

            {{-- Produk --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Produk</label>
                <select name="product_id" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
                    <option value="">-- Pilih Produk --</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Jumlah --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
                <input type="number" name="jumlah" min="1" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm"
                    value="{{ old('jumlah') }}">
            </div>

            {{-- Satuan --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Satuan</label>
                <select name="satuan" required class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
                    <option value="">-- Pilih Satuan --</option>
                    <option value="kg" {{ old('satuan') == 'kg' ? 'selected' : '' }}>kg</option>
                    <option value="pcs" {{ old('satuan') == 'pcs' ? 'selected' : '' }}>pcs</option>
                    <option value="Lt" {{ old('satuan') == 'Lt' ? 'selected' : '' }}>Lt</option>
                </select>
            </div>

            {{-- Tanggal --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                <input type="datetime-local" name="tanggal"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm"
                    value="{{ old('tanggal', now()->format('Y-m-d\TH:i')) }}">
            </div>

            {{-- Status --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status Konfirmasi</label>
                <select name="status_konfirmasi" class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
                    <option value="pending" {{ old('status_konfirmasi') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="diterima" {{ old('status_konfirmasi') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="ditolak" {{ old('status_konfirmasi') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end space-x-3 pt-4">
                <a href="{{ route($rolePrefix . '.barang_keluar.index') }}"
                   class="px-4 py-2 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 transition">Batal</a>
                <button type="submit"
                        class="px-4 py-2 rounded-md bg-green-600 text-white hover:bg-green-700 transition">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection