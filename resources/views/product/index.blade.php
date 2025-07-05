@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-xl font-bold mb-4">Tambah Produk</h1>
    
    {{-- Alert untuk success message --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    {{-- Alert untuk error message --}}
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.product.store') }}" class="space-y-4">
        @csrf
        
        {{-- Input Nama Produk --}}
        <div>
            <input type="text" 
                   name="nama" 
                   placeholder="Nama Produk" 
                   class="w-full border p-2 rounded @error('nama') border-red-500 @enderror" 
                   value="{{ old('nama') }}" 
                   required>
            @error('nama')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Input Kategori - Dropdown jika ada data categories --}}
        <div>
            @if(isset($categories) && $categories->count() > 0)
                <select name="kategori" class="w-full border p-2 rounded @error('kategori') border-red-500 @enderror">
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->nama }}" {{ old('kategori') == $category->nama ? 'selected' : '' }}>
                            {{ $category->nama }}
                        </option>
                    @endforeach
                </select>
            @else
                <input type="text" 
                       name="kategori" 
                       placeholder="Kategori" 
                       class="w-full border p-2 rounded @error('kategori') border-red-500 @enderror" 
                       value="{{ old('kategori') }}">
            @endif
            @error('kategori')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Input Stok --}}
        <div>
            <input type="number" 
                   name="stok" 
                   placeholder="Stok" 
                   class="w-full border p-2 rounded @error('stok') border-red-500 @enderror" 
                   value="{{ old('stok') }}" 
                   min="0"
                   required>
            @error('stok')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Input Satuan --}}
        <div>
            <input type="text" 
                   name="satuan" 
                   placeholder="Satuan (misal: pcs, kg, liter)" 
                   class="w-full border p-2 rounded @error('satuan') border-red-500 @enderror" 
                   value="{{ old('satuan') }}" 
                   required>
            @error('satuan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol Submit --}}
        <div class="flex gap-2">
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition-colors">
                Simpan Produk
            </button>
            <a href="{{ route('admin.product.index') }}" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition-colors">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection