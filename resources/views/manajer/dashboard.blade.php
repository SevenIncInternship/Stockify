@extends('layouts.app')

@section('title', 'Dashboard Manajer')

@section('content')
<div class="min-h-screen overflow-auto bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 p-6">
    <!-- Header -->
    <div class="mb-8 flex justify-between items-start flex-wrap gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Manajer</h1>
            <p class="text-gray-600">Selamat datang kembali! Berikut adalah ringkasan tugas dan stok.</p>
        </div>
        <div class="bg-white rounded-lg px-4 py-2 shadow text-center">
            <span class="text-sm text-gray-500 block">Tanggal</span>
            <span class="text-gray-800 font-semibold">{{ date('d M Y') }}</span>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-10">
        @php
            $stats = [
                ['label' => 'Total Produk', 'value' => $totalProduk, 'icon' => 'fa-box', 'color' => 'indigo', 'url' => route('manajer.barang_masuk.index')],
                ['label' => 'Barang Masuk Hari ini', 'value' => $barangMasuk, 'icon' => 'fa-arrow-down', 'color' => 'green', 'url' => route('manajer.barang_masuk.index')],
                ['label' => 'Barang Keluar Hari ini', 'value' => $barangKeluar, 'icon' => 'fa-arrow-up', 'color' => 'red', 'url' => route('manajer.barang_keluar.index')],
                ['label' => 'Stock Opname', 'value' => $totalOpname ?? '-', 'icon' => 'fa-clipboard-check', 'color' => 'yellow', 'url' => route('manajer.stock_opname.index')],
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

    <!-- Fitur Manajer -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Fitur Tugas Harian</h2>
            <ul class="space-y-3">
                <li>
                    <a href="{{ route('manajer.barang_masuk.create') }}"
                       class="flex items-center gap-3 text-green-700 hover:text-green-900 font-medium">
                        <i class="fas fa-plus-circle"></i> Terima Barang Masuk
                    </a>
                </li>
                <li>
                    <a href="{{ route('manajer.barang_keluar.create') }}"
                       class="flex items-center gap-3 text-red-700 hover:text-red-900 font-medium">
                        <i class="fas fa-minus-circle"></i> Catat Barang Keluar
                    </a>
                </li>
                <li>
                    <a href="{{ route('manajer.stock_opname.index') }}"
                       class="flex items-center gap-3 text-yellow-700 hover:text-yellow-900 font-medium">
                        <i class="fas fa-clipboard-list"></i> Lakukan Stock Opname
                    </a>
                </li>
                <a href="{{ route('manajer.dashboard_export_pdf') }}"
   class="flex items-center gap-3 text-blue-700 hover:text-blue-900 font-medium">
   <i class="fas fa-file-pdf"></i> Export Dashboard PDF
</a>

            </ul>
        </div>

        <!-- Chart Optional Placeholder -->
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">Grafik Stok Sederhana</h2>
            <p class="text-sm text-gray-500 mb-4">Monitoring stok saat ini</p>
            <canvas id="stokChart" height="220"></canvas>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const labels = @json($labelsProduk);
    const data = @json($stokDataProduk);

    new Chart(document.getElementById('stokChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Stok',
                data: data,
                backgroundColor: 'rgba(99, 102, 241, 0.7)',
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false }},
            scales: {
                y: { beginAtZero: true, title: { display: true, text: 'Jumlah Stok' }},
                x: { title: { display: true, text: 'Produk' }}
            }
        }
    });
});
</script>
@endpush
