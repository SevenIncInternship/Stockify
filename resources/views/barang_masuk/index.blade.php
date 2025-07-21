@php
    $rolePrefix = auth()->user()->role;
@endphp

@extends('layouts.app')

@section('title', 'Barang Masuk')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4 sm:p-6">
    <!-- Modern Header with Glass Effect -->
    <div class="backdrop-blur-sm bg-white/70 rounded-3xl p-6 mb-8 border border-white/20 shadow-xl">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-arrow-down text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                        Barang Masuk - {{ ucfirst($rolePrefix) }}
                    </h1>
                    <p class="text-gray-600 flex items-center gap-2 mt-1">
                        <i class="fas fa-info-circle text-blue-500 text-sm"></i>
                        Daftar semua barang masuk yang tercatat di sistem
                    </p>
                </div>
            </div>
            
            <!-- Action Button -->
            <div class="flex gap-3">
                <button class="p-3 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors duration-200 group">
                    <i class="fas fa-filter text-gray-600 group-hover:text-gray-800"></i>
                </button>
                <button class="p-3 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors duration-200 group">
                    <i class="fas fa-download text-gray-600 group-hover:text-gray-800"></i>
                </button>
                <a href="{{ route($rolePrefix . '.barang_masuk.create') }}" 
                   class="bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 flex items-center gap-2 group">
                    <i class="fas fa-plus group-hover:rotate-90 transition-transform duration-300"></i>
                    Tambah Barang Masuk
                </a>
            </div>
        </div>
    </div>

    <!-- Search & Filter Bar -->
    <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-4 mb-6 border border-white/20 shadow-lg">
        <div class="flex flex-col sm:flex-row gap-4 items-center">
            <div class="flex-1 relative">
                <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="text" 
                       placeholder="Cari berdasarkan nama produk..." 
                       class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                       id="searchInput">
            </div>
            <div class="flex gap-2">
                <select class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                    <option>Semua Status</option>
                    <option>Pending</option>
                    <option>Diterima</option>
                    <option>Ditolak</option>
                </select>
                <input type="date" class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
            </div>
        </div>
    </div>

    <!-- Modern Table Card -->
    <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl border border-white/20 overflow-hidden">
        <!-- Table Header -->
        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-table text-blue-600 text-sm"></i>
                    </div>
                    <h3 class="font-semibold text-gray-800">Data Barang Masuk</h3>
                </div>
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <i class="fas fa-database"></i>
                    <span>{{ count($barangMasuk) }} Data</span>
                </div>
            </div>
        </div>

        <!-- Table Content -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-box text-blue-500"></i>
                                Produk
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-sort-numeric-up text-green-500"></i>
                                Jumlah
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-calendar text-purple-500"></i>
                                Tanggal
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-flag text-orange-500"></i>
                                Status
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-cogs text-red-500"></i>
                                Aksi
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white/50 divide-y divide-gray-100">
                    @foreach ($barangMasuk as $item)
                    <tr class="hover:bg-white/80 transition-colors duration-200 group">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-cube text-blue-600"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">{{ $item->product->nama }}</div>
                                    <div class="text-sm text-gray-500">{{ $item->product->kode ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-plus text-green-600 text-xs"></i>
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900">{{ number_format($item->jumlah) }}</div>
                                    <div class="text-xs text-gray-500">{{ $item->satuan }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-calendar-day text-purple-600 text-xs"></i>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($item->tanggal)->diffForHumans() }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                switch ($item->status_konfirmasi) {
                                    case 'pending':
                                        $badgeConfig = [
                                            'bg' => 'bg-gradient-to-r from-yellow-100 to-amber-100',
                                            'text' => 'text-yellow-800',
                                            'border' => 'border-yellow-200',
                                            'icon' => 'fa-clock',
                                            'iconColor' => 'text-yellow-600'
                                        ];
                                        break;
                                    case 'diterima':
                                        $badgeConfig = [
                                            'bg' => 'bg-gradient-to-r from-green-100 to-emerald-100',
                                            'text' => 'text-green-800',
                                            'border' => 'border-green-200',
                                            'icon' => 'fa-check-circle',
                                            'iconColor' => 'text-green-600'
                                        ];
                                        break;
                                    case 'ditolak':
                                        $badgeConfig = [
                                            'bg' => 'bg-gradient-to-r from-red-100 to-pink-100',
                                            'text' => 'text-red-800',
                                            'border' => 'border-red-200',
                                            'icon' => 'fa-times-circle',
                                            'iconColor' => 'text-red-600'
                                        ];
                                        break;
                                    default:
                                        $badgeConfig = [
                                            'bg' => 'bg-gradient-to-r from-gray-100 to-slate-100',
                                            'text' => 'text-gray-800',
                                            'border' => 'border-gray-200',
                                            'icon' => 'fa-question-circle',
                                            'iconColor' => 'text-gray-600'
                                        ];
                                }
                            @endphp

                            <div class="inline-flex items-center gap-2 px-3 py-2 rounded-xl text-xs font-semibold {{ $badgeConfig['bg'] }} {{ $badgeConfig['text'] }} border {{ $badgeConfig['border'] }}">
                                <i class="fas {{ $badgeConfig['icon'] }} {{ $badgeConfig['iconColor'] }}"></i>
                                {{ ucfirst($item->status_konfirmasi) }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex gap-2">
                                <a href="{{ route($rolePrefix . '.barang_masuk.edit', $item->id) }}" 
                                   class="inline-flex items-center gap-2 px-3 py-2 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg text-sm font-medium transition-colors duration-200 group">
                                    <i class="fas fa-edit group-hover:scale-110 transition-transform duration-200"></i>
                                    <span class="hidden sm:inline">Edit</span>
                                </a>
                                <form action="{{ route($rolePrefix . '.barang_masuk.destroy', $item->id) }}" 
                                      method="POST" 
                                      class="inline"
                                      onsubmit="return confirm('Yakin ingin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center gap-2 px-3 py-2 bg-red-100 hover:bg-red-200 text-red-700 rounded-lg text-sm font-medium transition-colors duration-200 group">
                                        <i class="fas fa-trash group-hover:scale-110 transition-transform duration-200"></i>
                                        <span class="hidden sm:inline">Hapus</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Table Footer -->
        @if(count($barangMasuk) == 0)
        <div class="px-6 py-12 text-center">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-inbox text-gray-400 text-2xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Data</h3>
            <p class="text-gray-500 mb-6">Belum ada barang masuk yang tercatat di sistem.</p>
            <a href="{{ route($rolePrefix . '.barang_masuk.create') }}" 
               class="inline-flex items-center gap-2 px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg font-medium transition-colors duration-200">
                <i class="fas fa-plus"></i>
                Tambah Data Pertama
            </a>
        </div>
        @endif
    </div>

    <!-- Statistics Cards -->
    @if(count($barangMasuk) > 0)
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-8">
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-white/20 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Data</p>
                    <p class="text-2xl font-bold text-gray-800">{{ count($barangMasuk) }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-database text-blue-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-white/20 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Pending</p>
                    <p class="text-2xl font-bold text-yellow-600">{{ $barangMasuk->where('status_konfirmasi', 'pending')->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-white/20 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Diterima</p>
                    <p class="text-2xl font-bold text-green-600">{{ $barangMasuk->where('status_konfirmasi', 'diterima')->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-white/20 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Ditolak</p>
                    <p class="text-2xl font-bold text-red-600">{{ $barangMasuk->where('status_konfirmasi', 'ditolak')->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-times-circle text-red-600"></i>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Custom Styles -->
<style>
    /* Glass effect enhancement */
    .backdrop-blur-sm {
        backdrop-filter: blur(12px);
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
        height: 6px;
        width: 6px;
    }
    ::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb {
        background: linear-gradient(45deg, #3b82f6, #6366f1);
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(45deg, #2563eb, #4f46e5);
    }

    /* Gradient text */
    .bg-clip-text {
        -webkit-background-clip: text;
        background-clip: text;
    }

    /* Smooth animations */
    * {
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Table row hover effects */
    tbody tr:hover {
        transform: translateX(4px);
    }

    /* Input focus effects */
    input:focus, select:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
</style>

<!-- Enhanced Search Functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const tableRows = document.querySelectorAll('tbody tr');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        
        tableRows.forEach(row => {
            const productName = row.querySelector('td:first-child').textContent.toLowerCase();
            const shouldShow = productName.includes(searchTerm);
            
            if (shouldShow) {
                row.style.display = '';
                row.style.opacity = '1';
            } else {
                row.style.display = 'none';
                row.style.opacity = '0';
            }
        });
    });

    // Add smooth scroll behavior
    document.documentElement.style.scrollBehavior = 'smooth';
});
</script>
@endsection