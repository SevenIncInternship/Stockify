@extends('layouts.app')

@section('title', 'Tambah Barang Masuk')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow-md rounded-xl p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Tambah Barang Masuk</h2>

        <form method="POST" action="{{ route($rolePrefix . '.barang_masuk.store') }}" class="space-y-5">
            @csrf

            {{-- Produk --}}
            <div>
                <label class="block font-medium mb-1">📦 Produk</label>
                <select name="product_id" class="form-select w-full border-gray-300 rounded-md">
                    <option value="">-- Pilih Produk Lama --</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->nama }} (SKU: {{ $product->sku ?? '-' }})
                        </option>
                    @endforeach
                </select>

                <p class="text-sm text-gray-500 mt-1">Atau isi produk baru di bawah ini:</p>

                <input type="text" name="produk_baru" placeholder="Nama Produk Baru"
                    class="w-full mt-2 border border-gray-300 rounded-md px-3 py-2 text-sm"
                    value="{{ old('produk_baru') }}">
            </div>

            {{-- Kategori --}}
            <div>
                <label class="block font-medium mb-1">📁 Kategori</label>
                <select name="kategori_id" class="form-select w-full border-gray-300 rounded-md">
                    <option value="">-- Pilih Kategori Lama --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('kategori_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->nama }}
                        </option>
                    @endforeach
                </select>

                <input type="text" name="kategori_baru" placeholder="Kategori Baru (jika perlu)"
                    class="w-full mt-2 border border-gray-300 rounded-md px-3 py-2 text-sm"
                    value="{{ old('kategori_baru') }}">
            </div>

            {{-- Supplier --}}
            <div>
                <label class="block font-medium mb-1">🚚 Supplier</label>
                <select name="supplier_id" class="form-select w-full border-gray-300 rounded-md">
                    <option value="">-- Pilih Supplier Lama --</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->nama }}
                        </option>
                    @endforeach
                </select>

                <input type="text" name="supplier_baru" placeholder="Supplier Baru (jika perlu)"
                    class="w-full mt-2 border border-gray-300 rounded-md px-3 py-2 text-sm"
                    value="{{ old('supplier_baru') }}">
            </div>

            {{-- Jumlah --}}
            <div>
                <label class="block font-medium mb-1">Jumlah</label>
                <input type="number" name="jumlah" min="1" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm"
                    value="{{ old('jumlah') }}">
            </div>

            {{-- Satuan --}}
            <div>
                <label class="block font-medium mb-1">Satuan</label>
                <select name="satuan" required class="form-select w-full border-gray-300 rounded-md">
                    <option value="">-- Pilih Satuan --</option>
                    <option value="kg" {{ old('satuan') == 'kg' ? 'selected' : '' }}>kg</option>
                    <option value="pcs" {{ old('satuan') == 'pcs' ? 'selected' : '' }}>pcs</option>
                    <option value="Lt" {{ old('satuan') == 'Lt' ? 'selected' : '' }}>Lt</option>
                </select>
            </div>

            {{-- Tanggal --}}
            <div>
                <label class="block font-medium mb-1">🗓️ Tanggal</label>
                <input type="datetime-local" name="tanggal"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm"
                    value="{{ old('tanggal', $defaultTanggal) }}">
            </div>

            {{-- Status --}}
            <div>
                <label class="block font-medium mb-1">✅ Status Konfirmasi</label>
                <select name="status_konfirmasi" class="form-select w-full border-gray-300 rounded-md">
                    <option value="pending" {{ old('status_konfirmasi') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="diterima" {{ old('status_konfirmasi') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="ditolak" {{ old('status_konfirmasi') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route($rolePrefix . '.barang_masuk.index') }}"
                   class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md transition">Batal</a>
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
