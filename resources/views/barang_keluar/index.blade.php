@php
    $rolePrefix = auth()->user()->role;
@endphp

@extends('layouts.app')

@section('title', 'Barang Keluar')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-purple-50 to-pink-50">
    <!-- Header Section -->
    <div class="bg-white border-b border-gray-200 shadow-sm">
        <div class="container mx-auto px-6 py-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div class="space-y-2">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-gradient-to-r from-purple-600 to-pink-600 rounded-lg shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Barang Keluar</h1>
                            <div class="flex items-center gap-2 text-sm text-purple-600 font-medium">
                                <span class="px-2 py-1 bg-purple-100 rounded-full">{{ ucfirst($rolePrefix) }}</span>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600">Kelola dan pantau semua transaksi barang keluar</p>
                </div>
                
                <div class="flex items-center gap-3">
                    <div class="hidden lg:flex items-center gap-2 text-sm text-gray-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ now()->format('d M Y, H:i') }}</span>
                    </div>
                    <a href="{{ route($rolePrefix . '.barang_keluar.create') }}" 
                       class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-xl hover:from-purple-700 hover:to-pink-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span class="font-medium">Tambah Barang Keluar</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            @php
                $totalBarang = $barangKeluar->count();
                $pending = $barangKeluar->where('status_konfirmasi', 'pending')->count();
                $diterima = $barangKeluar->where('status_konfirmasi', 'diterima')->count();
                $ditolak = $barangKeluar->where('status_konfirmasi', 'ditolak')->count();
            @endphp
            
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Barang</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalBarang }}</p>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-xl">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Pending</p>
                        <p class="text-2xl font-bold text-yellow-600">{{ $pending }}</p>
                    </div>
                    <div class="p-3 bg-yellow-100 rounded-xl">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Diterima</p>
                        <p class="text-2xl font-bold text-green-600">{{ $diterima }}</p>
                    </div>
                    <div class="p-3 bg-green-100 rounded-xl">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Ditolak</p>
                        <p class="text-2xl font-bold text-red-600">{{ $ditolak }}</p>
                    </div>
                    <div class="p-3 bg-red-100 rounded-xl">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Table Header -->
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Data Barang Keluar
                    </h2>
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-2 text-sm text-gray-500">
                            <span>Total: <strong class="text-gray-900">{{ $totalBarang }}</strong> item</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"></path>
                                    </svg>
                                    Produk
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                    </svg>
                                    Jumlah
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Tanggal
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Status
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                    </svg>
                                    Aksi
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach ($barangKeluar as $item)
                            <tr class="hover:bg-gray-50 transition-all duration-200 group">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="p-2 bg-purple-100 rounded-lg mr-3 group-hover:bg-purple-200 transition-colors duration-200">
                                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $item->product->nama }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <span class="text-lg font-semibold text-gray-900">{{ $item->jumlah }}</span>
                                        <span class="text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded-full">{{ $item->satuan }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2 text-sm text-gray-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        switch ($item->status_konfirmasi) {
                                            case 'pending':
                                                $badgeColor = 'bg-yellow-100 text-yellow-800 border-yellow-200';
                                                $icon = '⏳';
                                                break;
                                            case 'diterima':
                                                $badgeColor = 'bg-green-100 text-green-800 border-green-200';
                                                $icon = '✅';
                                                break;
                                            case 'ditolak':
                                                $badgeColor = 'bg-red-100 text-red-800 border-red-200';
                                                $icon = '❌';
                                                break;
                                            default:
                                                $badgeColor = 'bg-gray-100 text-gray-800 border-gray-200';
                                                $icon = '❓';
                                        }
                                    @endphp
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium border {{ $badgeColor }}">
                                        <span>{{ $icon }}</span>
                                        {{ ucfirst($item->status_konfirmasi) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route($rolePrefix . '.barang_keluar.edit', $item->id) }}" 
                                           class="inline-flex items-center gap-1 px-3 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 hover:text-indigo-700 transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route($rolePrefix . '.barang_keluar.destroy', $item->id) }}" 
                                              method="POST" 
                                              class="inline-block"
                                              onsubmit="return confirm('⚠️ Apakah Anda yakin ingin menghapus data ini?\n\nData yang dihapus tidak dapat dikembalikan.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="inline-flex items-center gap-1 px-3 py-2 text-sm font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100 hover:text-red-700 transition-all duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @if ($barangKeluar->isEmpty())
                            <tr>
                                <td colspan="5" class="px-6 py-12">
                                    <div class="text-center">
                                        <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data barang keluar</h3>
                                        <p class="text-gray-500 mb-4">Mulai dengan menambahkan barang keluar pertama Anda</p>
                                        <a href="{{ route($rolePrefix . '.barang_keluar.create') }}" 
                                           class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:from-purple-700 hover:to-pink-700 transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                            Tambah Barang Keluar
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if (!$barangKeluar->isEmpty())
                <div class="bg-white px-6 py-4 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-700">
                            Menampilkan <strong>{{ $barangKeluar->firstItem() ?? 0 }}</strong> sampai <strong>{{ $barangKeluar->lastItem() ?? 0 }}</strong> dari <strong>{{ $barangKeluar->total() }}</strong> hasil
                        </div>
                        <div class="pagination-wrapper">
                            {{ $barangKeluar->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
/* Enhanced animations and transitions */
.container {
    animation: fadeInUp 0.6s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Hover effects for cards */
.hover\:shadow-lg:hover {
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Custom scrollbar */
.overflow-x-auto::-webkit-scrollbar {
    height: 6px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 10px;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 10px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

/* Enhanced button effects */
button:hover, .button:hover, a:hover {
    transform: translateY(-1px);
}

/* Loading animation for actions */
.loading {
    pointer-events: none;
    opacity: 0.7;
}

/* Enhanced pagination styles */
.pagination-wrapper .pagination {
    @apply flex items-center gap-1;
}

.pagination-wrapper .pagination .page-link {
    @apply px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-all duration-200;
}

.pagination-wrapper .pagination .page-item.active .page-link {
    @apply bg-purple-600 text-white border-purple-600 hover:bg-purple-700;
}

.pagination-wrapper .pagination .page-item.disabled .page-link {
    @apply text-gray-400 cursor-not-allowed hover:bg-white hover:text-gray-400;
}

/* Responsive improvements */
@media (max-width: 768px) {
    .container {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    .overflow-x-auto {
        -webkit-overflow-scrolling: touch;
    }
}

/* Stats cards animation on load */
.stats-card {
    animation: slideInFromLeft 0.6s ease-out forwards;
    opacity: 0;
}

.stats-card:nth-child(1) { animation-delay: 0.1s; }
.stats-card:nth-child(2) { animation-delay: 0.2s; }
.stats-card:nth-child(3) { animation-delay: 0.3s; }
.stats-card:nth-child(4) { animation-delay: 0.4s; }

@keyframes slideInFromLeft {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Table row hover enhancement */
tbody tr:hover {
    transform: scale(1.001);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add loading state to action buttons
    const actionButtons = document.querySelectorAll('form button[type="submit"]');
    actionButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (this.form.onsubmit && this.form.onsubmit() !== false) {
                this.innerHTML = `
                    <svg class="animate-spin w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Menghapus...
                `;
                this.disabled = true;
                this.classList.add('loading');
            }
        });
    });

    // Enhanced table animations
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach((row, index) => {
        row.style.animationDelay = `${index * 0.05}s`;
        row.classList.add('animate-fadeInUp');
    });

    // Add stats card animations
    const statsCards = document.querySelectorAll('.grid > div');
    statsCards.forEach((card, index) => {
        card.classList.add('stats-card');
    });

    // Real-time clock update (if needed)
    function updateClock() {
        const now = new Date();
        const clockElement = document.querySelector('.clock');
        if (clockElement) {
            clockElement.textContent = now.toLocaleString('id-ID', {
                day: '2-digit',
                month: 'short',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }
    }

    // Update clock every minute
    setInterval(updateClock, 60000);
});
</script>
@endsection