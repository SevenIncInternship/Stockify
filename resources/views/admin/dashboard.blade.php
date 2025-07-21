@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-blue-50 p-4 sm:p-6">
    <!-- Header with Glass Effect -->
    <div class="mb-8 backdrop-blur-sm bg-white/70 rounded-2xl p-6 border border-white/20 shadow-xl">
        <div class="flex justify-between items-start flex-wrap gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-chart-line text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                        Dashboard Admin
                    </h1>
                    <p class="text-gray-600 flex items-center gap-2 mt-1">
                        <i class="fas fa-wave-square text-blue-500 text-sm"></i>
                        Selamat datang kembali! Berikut adalah ringkasan inventory hari ini.
                    </p>
                </div>
            </div>
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl px-6 py-3 shadow-lg text-white">
                <div class="flex items-center gap-2">
                    <i class="fas fa-calendar-alt"></i>
                    <div class="text-center">
                        <span class="text-blue-100 text-xs block uppercase tracking-wide">Tanggal</span>
                        <span class="font-bold text-lg">{{ date('d M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modern Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-10">
        @php
            $stats = [
                ['label' => 'Total Produk', 'value' => $totalProduk, 'icon' => 'fa-box', 'gradient' => 'from-emerald-400 to-emerald-600', 'url' => route('admin.product.index')],
                ['label' => 'Barang Masuk', 'value' => $totalMasuk, 'icon' => 'fa-arrow-down', 'gradient' => 'from-blue-400 to-blue-600', 'url' => route('admin.barang_masuk.index')],
                ['label' => 'Barang Keluar', 'value' => $totalKeluar, 'icon' => 'fa-arrow-up', 'gradient' => 'from-red-400 to-red-600', 'url' => route('admin.barang_keluar.index')],
                ['label' => 'Total Pengguna', 'value' => $totalUser, 'icon' => 'fa-users', 'gradient' => 'from-purple-400 to-purple-600', 'url' => route('admin.users.index')],
                ['label' => 'Total Kategori', 'value' => $totalKategori, 'icon' => 'fa-tags', 'gradient' => 'from-amber-400 to-orange-500', 'url' => route('admin.category.index')],
                ['label' => 'Total Supplier', 'value' => $totalSupplier, 'icon' => 'fa-truck', 'gradient' => 'from-indigo-400 to-indigo-600', 'url' => route('admin.suppliers.index')],
            ];
        @endphp

        @foreach ($stats as $stat)
        <a href="{{ $stat['url'] }}"
           class="group relative bg-white/80 backdrop-blur-sm p-6 rounded-2xl shadow-lg border border-white/20 hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 overflow-hidden">
            <!-- Gradient Background on Hover -->
            <div class="absolute inset-0 bg-gradient-to-br {{ $stat['gradient'] }} opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
            
            <!-- Content -->
            <div class="relative z-10 flex justify-between items-center">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500 mb-1">{{ $stat['label'] }}</p>
                    <h3 class="text-2xl font-bold text-gray-800 group-hover:text-gray-900 transition-colors">{{ $stat['value'] }}</h3>
                </div>
                <div class="w-12 h-12 bg-gradient-to-br {{ $stat['gradient'] }} rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <i class="fas {{ $stat['icon'] }} text-white text-lg"></i>
                </div>
            </div>
            
            <!-- Hover Effect Border -->
            <div class="absolute inset-0 rounded-2xl border-2 border-transparent group-hover:border-gradient-to-r group-hover:{{ $stat['gradient'] }} transition-all duration-300"></div>
        </a>
        @endforeach
    </div>

    <!-- Modern Charts Section -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 pt-8">
        <!-- Stock Chart with Glass Effect -->
        <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl p-8 border border-white/20 hover:shadow-2xl transition-shadow duration-300">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-chart-bar text-white"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">Grafik Stok Produk</h2>
                    </div>
                    <p class="text-gray-500 flex items-center gap-2">
                        <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                        Monitoring stok inventory real-time
                    </p>
                </div>
                <div class="flex gap-2">
                    <button class="p-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                        <i class="fas fa-expand-alt text-gray-600"></i>
                    </button>
                    <button class="p-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                        <i class="fas fa-download text-gray-600"></i>
                    </button>
                </div>
            </div>
            <div class="relative">
                <canvas id="stokChart" height="250"></canvas>
            </div>
        </div>

        <!-- Activity Chart with Tabs -->
        <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl p-8 border border-white/20 hover:shadow-2xl transition-shadow duration-300">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-chart-line text-white"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800">Aktivitas Harian</h2>
                    </div>
                    <p class="text-gray-500 flex items-center gap-2">
                        <span class="w-2 h-2 bg-blue-400 rounded-full animate-pulse"></span>
                        Barang masuk & keluar 7 hari terakhir
                    </p>
                </div>
                <div class="flex gap-2">
                    <button class="p-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                        <i class="fas fa-expand-alt text-gray-600"></i>
                    </button>
                    <button class="p-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                        <i class="fas fa-download text-gray-600"></i>
                    </button>
                </div>
            </div>

            <!-- Modern Tab Design -->
            <div class="flex gap-1 mb-6 bg-gray-100 p-1 rounded-xl">
                <button id="tabMasuk" class="flex-1 px-4 py-3 rounded-lg bg-blue-500 text-white text-sm font-medium transition-all duration-200 flex items-center justify-center gap-2">
                    <i class="fas fa-arrow-down"></i>
                    Masuk
                </button>
                <button id="tabKeluar" class="flex-1 px-4 py-3 rounded-lg bg-transparent text-gray-600 text-sm font-medium transition-all duration-200 flex items-center justify-center gap-2 hover:bg-white">
                    <i class="fas fa-arrow-up"></i>
                    Keluar
                </button>
            </div>

            <!-- Charts Container -->
            <div class="relative">
                <canvas id="grafikMasuk" height="250"></canvas>
                <canvas id="grafikKeluar" height="250" class="hidden"></canvas>
            </div>
        </div>
    </div>

    <!-- Floating Action Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <div class="relative">
            <button class="w-14 h-14 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full shadow-2xl flex items-center justify-center text-white hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 hover:scale-110">
                <i class="fas fa-plus text-xl"></i>
            </button>
            <!-- Tooltip -->
            <div class="absolute right-16 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-3 py-2 rounded-lg text-sm whitespace-nowrap opacity-0 hover:opacity-100 pointer-events-none transition-opacity">
                Tambah Data Baru
                <div class="absolute left-full top-1/2 transform -translate-y-1/2 border-4 border-transparent border-l-gray-800"></div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    /* Custom scrollbar */
    ::-webkit-scrollbar {
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

    /* Glass effect enhancement */
    .backdrop-blur-sm {
        backdrop-filter: blur(8px);
    }

    /* Gradient text animation */
    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .bg-clip-text {
        -webkit-background-clip: text;
        background-clip: text;
    }

    /* Card hover effects */
    .group:hover .fas {
        animation: bounce 0.6s ease-in-out;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-4px); }
        60% { transform: translateY(-2px); }
    }

    /* Tab animation */
    .tab-transition {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
</style>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const labelsProduk = @json($labelsProduk);
    const stokData = @json($stokDataProduk);
    const labelsHarian = @json($labelsHarian);
    const dataMasuk = @json($dataMasukHarian);
    const dataKeluar = @json($dataKeluarHarian);

    // Enhanced Chart.js defaults
    Chart.defaults.font.family = 'system-ui, -apple-system, sans-serif';
    Chart.defaults.font.size = 12;

    // Modern Gradient for Stock Chart
    const stokCtx = document.getElementById('stokChart').getContext('2d');
    const stokGradient = stokCtx.createLinearGradient(0, 0, 0, 400);
    stokGradient.addColorStop(0, 'rgba(99, 102, 241, 0.8)');
    stokGradient.addColorStop(1, 'rgba(99, 102, 241, 0.2)');

    // Stock Chart with modern styling
    new Chart(stokCtx, {
        type: 'bar',
        data: {
            labels: labelsProduk,
            datasets: [{
                label: 'Jumlah Stok',
                data: stokData,
                backgroundColor: stokGradient,
                borderColor: 'rgb(99, 102, 241)',
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { 
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: 'white',
                    bodyColor: 'white',
                    cornerRadius: 8,
                    displayColors: false,
                }
            },
            scales: {
                y: { 
                    beginAtZero: true, 
                    title: { display: true, text: 'Stok', font: { weight: 'bold' } },
                    grid: { color: 'rgba(0, 0, 0, 0.1)' },
                    ticks: { font: { size: 11 } }
                },
                x: { 
                    title: { display: true, text: 'Produk', font: { weight: 'bold' } },
                    grid: { display: false },
                    ticks: { font: { size: 11 } }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            animation: {
                duration: 2000,
                easing: 'easeInOutQuart'
            }
        }
    });

    // Gradient for Masuk Chart
    const masukCtx = document.getElementById('grafikMasuk').getContext('2d');
    const masukGradient = masukCtx.createLinearGradient(0, 0, 0, 400);
    masukGradient.addColorStop(0, 'rgba(16, 185, 129, 0.8)');
    masukGradient.addColorStop(1, 'rgba(16, 185, 129, 0.2)');

    // Masuk Chart with modern styling
    const masukChart = new Chart(masukCtx, {
        type: 'bar',
        data: {
            labels: labelsHarian,
            datasets: [{
                label: 'Barang Masuk',
                data: dataMasuk,
                backgroundColor: masukGradient,
                borderColor: 'rgb(16, 185, 129)',
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { 
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: 'white',
                    bodyColor: 'white',
                    cornerRadius: 8,
                    displayColors: false,
                }
            },
            scales: {
                y: { 
                    beginAtZero: true, 
                    title: { display: true, text: 'Jumlah', font: { weight: 'bold' } },
                    grid: { color: 'rgba(0, 0, 0, 0.1)' },
                    ticks: { font: { size: 11 } }
                },
                x: { 
                    title: { display: true, text: 'Tanggal', font: { weight: 'bold' } },
                    grid: { display: false },
                    ticks: { font: { size: 11 } }
                }
            },
            animation: {
                duration: 2000,
                easing: 'easeInOutQuart'
            }
        }
    });

    // Gradient for Keluar Chart
    const keluarCtx = document.getElementById('grafikKeluar').getContext('2d');
    const keluarGradient = keluarCtx.createLinearGradient(0, 0, 0, 400);
    keluarGradient.addColorStop(0, 'rgba(239, 68, 68, 0.8)');
    keluarGradient.addColorStop(1, 'rgba(239, 68, 68, 0.2)');

    // Keluar Chart with modern styling
    const keluarChart = new Chart(keluarCtx, {
        type: 'bar',
        data: {
            labels: labelsHarian,
            datasets: [{
                label: 'Barang Keluar',
                data: dataKeluar,
                backgroundColor: keluarGradient,
                borderColor: 'rgb(239, 68, 68)',
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { 
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: 'white',
                    bodyColor: 'white',
                    cornerRadius: 8,
                    displayColors: false,
                }
            },
            scales: {
                y: { 
                    beginAtZero: true, 
                    title: { display: true, text: 'Jumlah', font: { weight: 'bold' } },
                    grid: { color: 'rgba(0, 0, 0, 0.1)' },
                    ticks: { font: { size: 11 } }
                },
                x: { 
                    title: { display: true, text: 'Tanggal', font: { weight: 'bold' } },
                    grid: { display: false },
                    ticks: { font: { size: 11 } }
                }
            },
            animation: {
                duration: 2000,
                easing: 'easeInOutQuart'
            }
        }
    });

    // Enhanced Tab functionality with smooth transitions
    const tabMasuk = document.getElementById('tabMasuk');
    const tabKeluar = document.getElementById('tabKeluar');
    const chartMasuk = document.getElementById('grafikMasuk');
    const chartKeluar = document.getElementById('grafikKeluar');

    function switchToMasuk() {
        // Chart visibility
        chartMasuk.classList.remove('hidden');
        chartKeluar.classList.add('hidden');
        
        // Tab styling
        tabMasuk.className = 'flex-1 px-4 py-3 rounded-lg bg-blue-500 text-white text-sm font-medium transition-all duration-200 flex items-center justify-center gap-2 shadow-md';
        tabKeluar.className = 'flex-1 px-4 py-3 rounded-lg bg-transparent text-gray-600 text-sm font-medium transition-all duration-200 flex items-center justify-center gap-2 hover:bg-white';
    }

    function switchToKeluar() {
        // Chart visibility
        chartKeluar.classList.remove('hidden');
        chartMasuk.classList.add('hidden');
        
        // Tab styling
        tabKeluar.className = 'flex-1 px-4 py-3 rounded-lg bg-red-500 text-white text-sm font-medium transition-all duration-200 flex items-center justify-center gap-2 shadow-md';
        tabMasuk.className = 'flex-1 px-4 py-3 rounded-lg bg-transparent text-gray-600 text-sm font-medium transition-all duration-200 flex items-center justify-center gap-2 hover:bg-white';
    }

    tabMasuk.addEventListener('click', switchToMasuk);
    tabKeluar.addEventListener('click', switchToKeluar);

    // Add smooth scroll behavior
    document.documentElement.style.scrollBehavior = 'smooth';
});
</script>
@endpush