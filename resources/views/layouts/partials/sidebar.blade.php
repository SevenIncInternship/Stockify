<aside class="w-64 bg-slate-900 text-white min-h-screen fixed">
    <div class="p-6 text-white text-xl font-bold border-b border-slate-700">
        @php
            $role = auth()->check() ? auth()->user()->role : null;
        @endphp

        @if ($role === 'admin')
            Admin Panel
        @elseif ($role === 'manajer')
            Manajer Panel
        @elseif ($role === 'staff')
            Staff Panel
        @else
            Akses Tidak Dikenali
        @endif
    </div>

    <ul class="mt-4">
        @if ($role === 'admin')
            <li>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 hover:bg-slate-800">
                    <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.product.index') }}" class="flex items-center px-6 py-3 hover:bg-slate-800">
                    <i class="fas fa-box mr-3"></i> Produk
                </a>
            </li>
            <li>
                <a href="{{ route('admin.barang_masuk.index') }}" class="flex items-center px-6 py-3 hover:bg-slate-800">
                    <i class="fas fa-arrow-down mr-3"></i> Barang Masuk
                </a>
            </li>
            <li>
                <a href="{{ route('admin.barang_keluar.index') }}" class="flex items-center px-6 py-3 hover:bg-slate-800">
                    <i class="fas fa-arrow-up mr-3"></i> Barang Keluar
                </a>
            </li>
            <li>
                <a href="{{ route('admin.category.index') }}" class="flex items-center px-6 py-3 hover:bg-slate-800">
                    <i class="fas fa-tags mr-3"></i> Kategori
                </a>
            </li>
            <li>
                <a href="{{ route('admin.suppliers.index') }}" class="flex items-center px-6 py-3 hover:bg-slate-800">
                    <i class="fas fa-truck mr-3"></i> Supplier
                </a>
            </li>
            <li>
                <a href="{{ route('admin.laporan.barangMasuk.pdf') }}" class="flex items-center px-6 py-3 hover:bg-slate-800">
                    <i class="fas fa-file-pdf mr-3"></i> Laporan
                </a>
            </li>
        @elseif ($role === 'manajer')
            <li>
                <a href="{{ route('manajer.dashboard') }}" class="flex items-center px-6 py-3 hover:bg-slate-800">
                    <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('manajer.barang_masuk.index') }}" class="flex items-center px-6 py-3 hover:bg-slate-800">
                    <i class="fas fa-arrow-down mr-3"></i> Barang Masuk
                </a>
            </li>
            <li>
                <a href="{{ route('manajer.barang_keluar.index') }}" class="flex items-center px-6 py-3 hover:bg-slate-800">
                    <i class="fas fa-arrow-up mr-3"></i> Barang Keluar
                </a>
            </li>
            <li>
                <a href="{{ route('manajer.laporan.index') }}" class="flex items-center px-6 py-3 hover:bg-slate-800">
                    <i class="fas fa-chart-line mr-3"></i> Laporan
                </a>
            </li>
            <li>
                <a href="{{ route('manajer.produk.index') }}" class="flex items-center px-6 py-3 hover:bg-slate-800">
                    <i class="fas fa-box mr-3"></i> Produk
                </a>
            </li>
            <li>
                <a href="{{ route('manajer.supplier.index') }}" class="flex items-center px-6 py-3 hover:bg-slate-800">
                    <i class="fas fa-truck mr-3"></i> Supplier
                </a>
            </li>
        @elseif ($role === 'staff')
            <li>
                <a href="{{ route('staff.dashboard') }}" class="flex items-center px-6 py-3 hover:bg-slate-800">
                    <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('staff.barangMasuk.konfirmasi', ['id' => 1]) }}" class="flex items-center px-6 py-3 hover:bg-slate-800">
                    <i class="fas fa-check-circle mr-3"></i> Konfirmasi Barang Masuk
                </a>
            </li>
            <li>
                <a href="{{ route('staff.barangKeluar.konfirmasi', ['id' => 1]) }}" class="flex items-center px-6 py-3 hover:bg-slate-800">
                    <i class="fas fa-check-circle mr-3"></i> Konfirmasi Barang Keluar
                </a>
            </li>
        @endif

        {{-- Logout tombol universal --}}
        <li class="mt-8 border-t border-slate-700">
            <form action="{{ route('logout') }}" method="POST" class="flex items-center px-6 py-3 hover:bg-slate-800">
                @csrf
                <button type="submit" class="flex items-center w-full text-left">
                    <i class="fas fa-sign-out-alt mr-3 text-red-400"></i> <span class="text-red-400">Keluar</span>
                </button>
            </form>
        </li>
    </ul>
</aside>
