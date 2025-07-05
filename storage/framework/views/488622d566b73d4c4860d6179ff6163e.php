<?php $__env->startSection('title', 'Dashboard Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 p-6">
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Dashboard Admin</h1>
                <p class="text-gray-600">Selamat datang kembali! Berikut adalah ringkasan inventory hari ini.</p>
            </div>
            <div class="hidden md:flex items-center space-x-4">
                <div class="bg-white rounded-lg px-4 py-2 shadow-sm">
                    <span class="text-sm text-gray-500">Tanggal</span>
                    <p class="font-semibold text-gray-800"><?php echo e(date('d M Y')); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6 mb-8">
        <!-- Total Produk -->
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 border-l-4 border-green-500 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Produk</p>
                    <p class="text-2xl font-bold text-gray-800"><?php echo e($totalProduk); ?></p>
                </div>
                <div class="bg-green-100 rounded-full p-3 group-hover:bg-green-200 transition-colors">
                    <i class="fas fa-box text-green-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-3">
                <div class="bg-green-50 rounded-lg px-3 py-1">
                    <span class="text-green-700 text-xs font-medium">Produk Aktif</span>
                </div>
            </div>
        </div>

        <!-- Total Barang Masuk -->
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 border-l-4 border-blue-500 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Barang Masuk</p>
                    <p class="text-2xl font-bold text-gray-800"><?php echo e($totalMasuk); ?></p>
                </div>
                <div class="bg-blue-100 rounded-full p-3 group-hover:bg-blue-200 transition-colors">
                    <i class="fas fa-arrow-down text-blue-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-3">
                <div class="bg-blue-50 rounded-lg px-3 py-1">
                    <span class="text-blue-700 text-xs font-medium">Total Masuk</span>
                </div>
            </div>
        </div>

        <!-- Total Barang Keluar -->
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 border-l-4 border-red-500 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Barang Keluar</p>
                    <p class="text-2xl font-bold text-gray-800"><?php echo e($totalKeluar); ?></p>
                </div>
                <div class="bg-red-100 rounded-full p-3 group-hover:bg-red-200 transition-colors">
                    <i class="fas fa-arrow-up text-red-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-3">
                <div class="bg-red-50 rounded-lg px-3 py-1">
                    <span class="text-red-700 text-xs font-medium">Total Keluar</span>
                </div>
            </div>
        </div>

        <!-- Total Pengguna -->
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 border-l-4 border-purple-500 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Pengguna</p>
                    <p class="text-2xl font-bold text-gray-800"><?php echo e($totalUser); ?></p>
                </div>
                <div class="bg-purple-100 rounded-full p-3 group-hover:bg-purple-200 transition-colors">
                    <i class="fas fa-users text-purple-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-3">
                <div class="bg-purple-50 rounded-lg px-3 py-1">
                    <span class="text-purple-700 text-xs font-medium">Pengguna Aktif</span>
                </div>
            </div>
        </div>

        <!-- Total Kategori -->
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 border-l-4 border-yellow-500 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Kategori</p>
                    <p class="text-2xl font-bold text-gray-800"><?php echo e($totalKategori); ?></p>
                </div>
                <div class="bg-yellow-100 rounded-full p-3 group-hover:bg-yellow-200 transition-colors">
                    <i class="fas fa-tags text-yellow-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-3">
                <div class="bg-yellow-50 rounded-lg px-3 py-1">
                    <span class="text-yellow-700 text-xs font-medium">Kategori Aktif</span>
                </div>
            </div>
        </div>

        <!-- Total Supplier -->
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 border-l-4 border-indigo-500 group hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Supplier</p>
                    <p class="text-2xl font-bold text-gray-800"><?php echo e($totalSupplier); ?></p>
                </div>
                <div class="bg-indigo-100 rounded-full p-3 group-hover:bg-indigo-200 transition-colors">
                    <i class="fas fa-truck text-indigo-600 text-xl"></i>
                </div>
            </div>
            <div class="mt-3">
                <div class="bg-indigo-50 rounded-lg px-3 py-1">
                    <span class="text-indigo-700 text-xs font-medium">Supplier Aktif</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
        <!-- Grafik Stok Produk -->
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Grafik Stok Produk</h2>
                    <p class="text-sm text-gray-600">Monitoring stok inventory real-time</p>
                </div>
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-full p-3">
                    <i class="fas fa-chart-bar text-white text-lg"></i>
                </div>
            </div>
            <div class="relative">
                <canvas id="stokChart" height="300"></canvas>
            </div>
        </div>

        <!-- Grafik Barang Masuk & Keluar -->
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Aktivitas Harian</h2>
                    <p class="text-sm text-gray-600">Barang masuk & keluar 7 hari terakhir</p>
                </div>
                <div class="bg-gradient-to-r from-green-500 to-teal-600 rounded-full p-3">
                    <i class="fas fa-chart-line text-white text-lg"></i>
                </div>
            </div>
            
            <!-- Tabs untuk Grafik -->
            <div class="flex space-x-1 mb-4 bg-gray-100 rounded-lg p-1">
                <button id="tabMasuk" class="flex-1 py-2 px-4 text-sm font-medium rounded-md transition-colors bg-white text-gray-800 shadow-sm">
                    <i class="fas fa-arrow-down mr-2"></i>Barang Masuk
                </button>
                <button id="tabKeluar" class="flex-1 py-2 px-4 text-sm font-medium rounded-md transition-colors text-gray-600 hover:text-gray-800">
                    <i class="fas fa-arrow-up mr-2"></i>Barang Keluar
                </button>
            </div>
            
            <div class="relative">
                <canvas id="grafikMasuk" height="250" class="chart-canvas"></canvas>
                <canvas id="grafikKeluar" height="250" class="chart-canvas hidden"></canvas>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-8 bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="#" class="flex items-center p-4 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl text-white hover:from-blue-600 hover:to-blue-700 transition-all group">
                <i class="fas fa-plus-circle mr-3 text-xl group-hover:scale-110 transition-transform"></i>
                <span class="font-medium">Tambah Produk</span>
            </a>
            <a href="#" class="flex items-center p-4 bg-gradient-to-r from-green-500 to-green-600 rounded-xl text-white hover:from-green-600 hover:to-green-700 transition-all group">
                <i class="fas fa-download mr-3 text-xl group-hover:scale-110 transition-transform"></i>
                <span class="font-medium">Barang Masuk</span>
            </a>
            <a href="#" class="flex items-center p-4 bg-gradient-to-r from-red-500 to-red-600 rounded-xl text-white hover:from-red-600 hover:to-red-700 transition-all group">
                <i class="fas fa-upload mr-3 text-xl group-hover:scale-110 transition-transform"></i>
                <span class="font-medium">Barang Keluar</span>
            </a>
            <a href="#" class="flex items-center p-4 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl text-white hover:from-purple-600 hover:to-purple-700 transition-all group">
                <i class="fas fa-chart-pie mr-3 text-xl group-hover:scale-110 transition-transform"></i>
                <span class="font-medium">Laporan</span>
            </a>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Fungsi pembantu untuk opsi chart yang umum
        function chartOptions(labelX, labelY, tooltipUnit = '') {
            return {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { 
                        display: true, 
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                size: 12,
                                family: "'Inter', sans-serif"
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: 'white',
                        bodyColor: 'white',
                        borderColor: 'rgba(255, 255, 255, 0.1)',
                        borderWidth: 1,
                        cornerRadius: 8,
                        callbacks: {
                            label: function (context) {
                                let label = context.dataset.label || '';
                                if (label) label += ': ';
                                if (context.parsed.y !== null) {
                                    label += context.parsed.y.toLocaleString() + (tooltipUnit ? ' ' + tooltipUnit : '');
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { 
                            display: true, 
                            text: labelY,
                            font: {
                                size: 12,
                                family: "'Inter', sans-serif"
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            font: {
                                size: 11,
                                family: "'Inter', sans-serif"
                            }
                        }
                    },
                    x: {
                        title: { 
                            display: true, 
                            text: labelX,
                            font: {
                                size: 12,
                                family: "'Inter', sans-serif"
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            font: {
                                size: 11,
                                family: "'Inter', sans-serif"
                            }
                        }
                    }
                }
            };
        }

        // Inisialisasi Grafik Stok Produk (Bar Chart)
        const ctxStok = document.getElementById('stokChart');
        if (ctxStok) {
            new Chart(ctxStok, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($labelsProduk ?? []); ?>,
                    datasets: [{
                        label: 'Jumlah Stok',
                        data: <?php echo json_encode($stokDataProduk ?? []); ?>,
                        backgroundColor: 'rgba(99, 102, 241, 0.8)',
                        borderColor: 'rgba(99, 102, 241, 1)',
                        borderWidth: 2,
                        borderRadius: 6,
                        borderSkipped: false,
                    }]
                },
                options: chartOptions('Produk', 'Stok', 'unit')
            });
        }

        // Inisialisasi Grafik Barang Masuk Harian (Bar Chart)
        const ctxMasuk = document.getElementById('grafikMasuk');
        let chartMasuk;
        if (ctxMasuk) {
            chartMasuk = new Chart(ctxMasuk, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($labelsHarian ?? []); ?>,
                    datasets: [{
                        label: 'Barang Masuk',
                        data: <?php echo json_encode($dataMasukHarian ?? []); ?>,
                        backgroundColor: 'rgba(16, 185, 129, 0.8)',
                        borderColor: 'rgba(16, 185, 129, 1)',
                        borderWidth: 2,
                        borderRadius: 6,
                        borderSkipped: false,
                    }]
                },
                options: chartOptions('Tanggal', 'Jumlah', 'unit')
            });
        }

        // Inisialisasi Grafik Barang Keluar Harian (Bar Chart)
        const ctxKeluar = document.getElementById('grafikKeluar');
        let chartKeluar;
        if (ctxKeluar) {
            chartKeluar = new Chart(ctxKeluar, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($labelsHarian ?? []); ?>,
                    datasets: [{
                        label: 'Barang Keluar',
                        data: <?php echo json_encode($dataKeluarHarian ?? []); ?>,
                        backgroundColor: 'rgba(239, 68, 68, 0.8)',
                        borderColor: 'rgba(239, 68, 68, 1)',
                        borderWidth: 2,
                        borderRadius: 6,
                        borderSkipped: false,
                    }]
                },
                options: chartOptions('Tanggal', 'Jumlah', 'unit')
            });
        }

        // Tab functionality untuk grafik
        const tabMasuk = document.getElementById('tabMasuk');
        const tabKeluar = document.getElementById('tabKeluar');
        const chartCanvases = document.querySelectorAll('.chart-canvas');

        tabMasuk.addEventListener('click', function() {
            tabMasuk.classList.add('bg-white', 'text-gray-800', 'shadow-sm');
            tabMasuk.classList.remove('text-gray-600');
            tabKeluar.classList.remove('bg-white', 'text-gray-800', 'shadow-sm');
            tabKeluar.classList.add('text-gray-600');
            
            document.getElementById('grafikMasuk').classList.remove('hidden');
            document.getElementById('grafikKeluar').classList.add('hidden');
        });

        tabKeluar.addEventListener('click', function() {
            tabKeluar.classList.add('bg-white', 'text-gray-800', 'shadow-sm');
            tabKeluar.classList.remove('text-gray-600');
            tabMasuk.classList.remove('bg-white', 'text-gray-800', 'shadow-sm');
            tabMasuk.classList.add('text-gray-600');
            
            document.getElementById('grafikKeluar').classList.remove('hidden');
            document.getElementById('grafikMasuk').classList.add('hidden');
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\KULIAH\KP\REPO\Stockify\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>