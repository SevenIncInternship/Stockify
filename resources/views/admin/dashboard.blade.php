@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="min-h-screen overflow-auto bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 p-6">
    <!-- Header -->
    <div class="mb-8 flex justify-between items-start flex-wrap gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Admin</h1>
            <p class="text-gray-600">Selamat datang kembali! Berikut adalah ringkasan inventory hari ini.</p>
        </div>
        <div class="bg-white rounded-lg px-4 py-2 shadow text-center">
            <span class="text-sm text-gray-500 block">Tanggal</span>
            <span class="text-gray-800 font-semibold">{{ date('d M Y') }}</span>
        </div>
    </div>

    <!-- Stat Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-10">
    @php
        $stats = [
            ['label' => 'Total Produk', 'value' => $totalProduk, 'icon' => 'fa-box', 'color' => 'green', 'url' => route('admin.product.index')],
            ['label' => 'Barang Masuk', 'value' => $totalMasuk, 'icon' => 'fa-arrow-down', 'color' => 'blue', 'url' => route('admin.barang_masuk.index')],
            ['label' => 'Barang Keluar', 'value' => $totalKeluar, 'icon' => 'fa-arrow-up', 'color' => 'red', 'url' => route('admin.barang_keluar.index')],
            ['label' => 'Total Pengguna', 'value' => $totalUser, 'icon' => 'fa-users', 'color' => 'purple', 'url' => route('admin.users.index')],
            ['label' => 'Total Kategori', 'value' => $totalKategori, 'icon' => 'fa-tags', 'color' => 'yellow', 'url' => route('admin.category.index')],
            ['label' => 'Total Supplier', 'value' => $totalSupplier, 'icon' => 'fa-truck', 'color' => 'indigo', 'url' => route('admin.suppliers.index')],
        ];
    @endphp

    @foreach ($stats as $stat)
    <a href="{{ $stat['url'] }}"
       class="bg-white p-4 rounded-xl shadow border-l-4 border-{{ $stat['color'] }}-500 flex justify-between items-center hover:scale-[1.03] transition-transform hover:bg-{{ $stat['color'] }}-50">
        <div>
            <p class="text-sm text-gray-500">{{ $stat['label'] }}</p>
            <h3 class="text-2xl font-bold text-gray-800">{{ $stat['value'] }}</h3>
        </div>
        <div class="p-3 rounded-full bg-{{ $stat['color'] }}-100 text-{{ $stat['color'] }}-600">
            <i class="fas {{ $stat['icon'] }} text-xl"></i>
        </div>
    </a>
    @endforeach
</div>


    <!-- Charts -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 pt-6 border-t border-gray-200">
        <!-- Grafik Stok Produk -->
        <div class  ="bg-white rounded-xl shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">Grafik Stok Produk</h2>
                    <p class="text-sm text-gray-500">Monitoring stok inventory real-time</p>
                </div>
                <div class="p-2 bg-indigo-500 text-white rounded-full">
                    <i class="fas fa-chart-bar"></i>
                </div>
            </div>
            <canvas id="stokChart" height="250"></canvas>
        </div>

        <!-- Grafik Aktivitas Harian -->
        <div class="bg-white rounded-xl shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">Aktivitas Harian</h2>
                    <p class="text-sm text-gray-500">Barang masuk & keluar 7 hari terakhir</p>
                </div>
                <div class="p-2 bg-green-500 text-white rounded-full">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>

            <!-- Tab -->
            <div class="flex gap-2 mb-4">
                <button id="tabMasuk" class="px-4 py-2 rounded-md bg-blue-500 text-white text-sm">Masuk</button>
                <button id="tabKeluar" class="px-4 py-2 rounded-md bg-gray-200 text-gray-700 text-sm">Keluar</button>
            </div>

            <!-- Canvas -->
            <canvas id="grafikMasuk" height="250"></canvas>
            <canvas id="grafikKeluar" height="250" class="hidden"></canvas>
        </div>
    </div>
</div>
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

    // Grafik Stok
    new Chart(document.getElementById('stokChart'), {
        type: 'bar',
        data: {
            labels: labelsProduk,
            datasets: [{
                label: 'Jumlah Stok',
                data: stokData,
                backgroundColor: 'rgba(99, 102, 241, 0.7)',
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false }},
            scales: {
                y: { beginAtZero: true, title: { display: true, text: 'Stok' }},
                x: { title: { display: true, text: 'Produk' }}
            }
        }
    });

    // Grafik Masuk
    const masukChart = new Chart(document.getElementById('grafikMasuk'), {
        type: 'bar',
        data: {
            labels: labelsHarian,
            datasets: [{
                label: 'Barang Masuk',
                data: dataMasuk,
                backgroundColor: 'rgba(16, 185, 129, 0.8)',
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false }},
            scales: {
                y: { beginAtZero: true, title: { display: true, text: 'Jumlah' }},
                x: { title: { display: true, text: 'Tanggal' }}
            }
        }
    });

    // Grafik Keluar
    const keluarChart = new Chart(document.getElementById('grafikKeluar'), {
        type: 'bar',
        data: {
            labels: labelsHarian,
            datasets: [{
                label: 'Barang Keluar',
                data: dataKeluar,
                backgroundColor: 'rgba(239, 68, 68, 0.8)',
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false }},
            scales: {
                y: { beginAtZero: true, title: { display: true, text: 'Jumlah' }},
                x: { title: { display: true, text: 'Tanggal' }}
            }
        }
    });

    // Tab logic
    document.getElementById('tabMasuk').addEventListener('click', () => {
        document.getElementById('grafikMasuk').classList.remove('hidden');
        document.getElementById('grafikKeluar').classList.add('hidden');
        tabMasuk.classList.replace('bg-gray-200', 'bg-blue-500');
        tabMasuk.classList.replace('text-gray-700', 'text-white');
        tabKeluar.classList.replace('bg-blue-500', 'bg-gray-200');
        tabKeluar.classList.replace('text-white', 'text-gray-700');
    });

    document.getElementById('tabKeluar').addEventListener('click', () => {
        document.getElementById('grafikKeluar').classList.remove('hidden');
        document.getElementById('grafikMasuk').classList.add('hidden');
        tabKeluar.classList.replace('bg-gray-200', 'bg-blue-500');
        tabKeluar.classList.replace('text-gray-700', 'text-white');
        tabMasuk.classList.replace('bg-blue-500', 'bg-gray-200');
        tabMasuk.classList.replace('text-white', 'text-gray-700');
    });
});
</script>
@endpush