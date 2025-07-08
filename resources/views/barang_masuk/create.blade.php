@extends('layouts.app')

@section('title', 'Tambah Barang Masuk')

@section('content')
<div class="max-w-xl mx-auto bg-white shadow p-6 rounded">
    <h1 class="text-xl font-bold mb-4 text-gray-800">Tambah Barang Masuk</h1>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 p-3 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.barang_masuk.store') }}">
        @csrf

        <!-- Produk -->
        <div class="mb-4">
            <label for="product_id" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk (Pilih atau Tambah Baru)</label>
            <select name="product_id" id="product_id" class="w-full mb-2 p-2 border border-gray-300 rounded">
                <option value="">-- Pilih Produk --</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->nama }}
                    </option>
                @endforeach
            </select>
            <input type="text" name="produk_baru" class="w-full p-2 border border-gray-300 rounded" placeholder="Atau ketik nama produk baru" value="{{ old('produk_baru') }}">
        </div>

        <!-- Kategori -->
        <div class="mb-4">
            <label for="kategori_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori (untuk produk baru)</label>
            <select name="kategori_id" id="kategori_id" class="w-full mb-2 p-2 border border-gray-300 rounded">
                <option value="">-- Pilih Kategori Lama --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('kategori_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->nama }}
                    </option>
                @endforeach
            </select>
            <input type="text" name="kategori_baru" class="w-full p-2 border border-gray-300 rounded" placeholder="Atau ketik kategori baru" value="{{ old('kategori_baru') }}">
        </div>

        <!-- Supplier -->
        <div class="mb-4">
            <label for="supplier_id" class="block text-sm font-medium text-gray-700 mb-1">Supplier (Pilih atau Tambah Baru)</label>
            <select name="supplier_id" id="supplier_id" class="w-full mb-2 p-2 border border-gray-300 rounded">
                <option value="">-- Pilih Supplier --</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->nama }}
                    </option>
                @endforeach
            </select>
            <input type="text" name="supplier_baru" class="w-full p-2 border border-gray-300 rounded" placeholder="Atau ketik nama supplier baru" value="{{ old('supplier_baru') }}">
        </div>

        <!-- Jumlah -->
        <div class="mb-4">
            <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" min="1" required class="w-full mt-1 p-2 border border-gray-300 rounded" value="{{ old('jumlah') }}">
        </div>

        <!-- Satuan -->
        <div class="mb-4">
            <label for="satuan" class="block text-sm font-medium text-gray-700">Satuan</label>
            <select name="satuan" id="satuan" required class="w-full mt-1 p-2 border border-gray-300 rounded">
                <option value="">-- Pilih Satuan --</option>
                <option value="kg" {{ old('satuan') == 'kg' ? 'selected' : '' }}>kg</option>
                <option value="pcs" {{ old('satuan') == 'pcs' ? 'selected' : '' }}>pcs</option>
                <option value="Lt" {{ old('satuan') == 'Lt' ? 'selected' : '' }}>Lt</option>
            </select>
        </div>

        <!-- Tanggal -->
        <div class="mb-4">
            <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="w-full mt-1 p-2 border border-gray-300 rounded" value="{{ old('tanggal', now()->format('Y-m-d')) }}">
        </div>

        <!-- Status Konfirmasi -->
        <div class="mb-4">
            <label for="status_konfirmasi" class="block text-sm font-medium text-gray-700">Status Konfirmasi</label>
            <select name="status_konfirmasi" id="status_konfirmasi" required class="w-full mt-1 p-2 border border-gray-300 rounded">
                <option value="pending" {{ old('status_konfirmasi') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="diterima" {{ old('status_konfirmasi') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="ditolak" {{ old('status_konfirmasi') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>

        <!-- Tombol -->
        <div class="flex justify-end">
            <a href="{{ route('admin.barang_masuk.index') }}" class="text-gray-500 mr-4 hover:underline">Batal</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
        </div>
    </form>
</div>

{{-- Validasi JS: Produk dan Supplier wajib salah satu diisi. Kategori wajib jika tambah produk --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');
        form.addEventListener('submit', function (e) {
            const produkBaru = document.querySelector('[name="produk_baru"]').value.trim();
            const produkLama = document.querySelector('[name="product_id"]').value;
            const kategoriBaru = document.querySelector('[name="kategori_baru"]').value.trim();
            const kategoriLama = document.querySelector('[name="kategori_id"]').value;
            const supplierBaru = document.querySelector('[name="supplier_baru"]').value.trim();
            const supplierLama = document.querySelector('[name="supplier_id"]').value;

            if (!produkBaru && !produkLama) {
                alert('Pilih produk lama atau isi nama produk baru.');
                e.preventDefault();
                return;
            }

            if (produkBaru && !kategoriBaru && !kategoriLama) {
                alert('Pilih kategori lama atau isi kategori baru untuk produk baru.');
                e.preventDefault();
                return;
            }

            if (!supplierBaru && !supplierLama) {
                alert('Pilih supplier lama atau isi nama supplier baru.');
                e.preventDefault();
                return;
            }
        });
    });
</script>
@endsection