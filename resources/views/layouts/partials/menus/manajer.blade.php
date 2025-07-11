<div class="w-64 bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900 shadow-2xl min-h-screen relative overflow-hidden">
    <div class="relative z-10 p-6 border-b border-slate-700/50">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                <i class="fas fa-cube text-white text-lg"></i>
            </div>
            <div>
                <h2 class="text-white font-bold text-lg">Manajer Panel</h2>
                <p class="text-slate-400 text-xs">Inventory Management</p>
            </div>
        </div>
    </div>

    <nav class="relative z-10 p-4 space-y-2">
        <ul class="space-y-1">
            <li>
                <a href="{{ route('manajer.dashboard') }}" class="sidebar-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li>
                <a href="{{ route('manajer.barang_masuk.index') }}" class="sidebar-link"><i class="fas fa-arrow-down"></i> Barang Masuk</a>
            </li>
            <li>
                <a href="{{ route('manajer.barang_keluar.index') }}" class="sidebar-link"><i class="fas fa-arrow-up"></i> Barang Keluar</a>
            </li>
            <li>
                <a href="{{ route('manajer.laporan.index') }}" class="sidebar-link"><i class="fas fa-chart-bar"></i> Laporan</a>
            </li>
            <li>
                <a href="{{ route('manajer.supplier.index') }}" class="sidebar-link"><i class="fas fa-truck"></i> Supplier</a>
            </li>
            <li>
                <a href="{{ route('manajer.produk.index') }}" class="sidebar-link"><i class="fas fa-box"></i> Produk</a>
            </li>
        </ul>
    </nav>

    <div class="p-4 border-t border-slate-700/50">
        <div class="text-slate-300 text-sm mb-2">{{ auth()->user()->name }}</div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full text-left text-red-400 hover:text-red-300">Keluar</button>
        </form>
    </div>
</div>
