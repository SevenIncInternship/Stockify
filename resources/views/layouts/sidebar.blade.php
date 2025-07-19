@php
    $role = auth()->user()->role;
    $navItems = [];

    if ($role === 'admin') {
        $navItems = [
            ['route' => 'admin.dashboard', 'icon' => 'fa-tachometer-alt', 'label' => 'Dashboard', 'color' => 'blue'],
            ['route' => 'admin.barang_masuk.index', 'icon' => 'fa-arrow-down', 'label' => 'Barang Masuk', 'color' => 'cyan'],
            ['route' => 'admin.barang_keluar.index', 'icon' => 'fa-arrow-up', 'label' => 'Barang Keluar', 'color' => 'red'],
            ['route' => 'admin.product.index', 'icon' => 'fa-box', 'label' => 'Stok Produk', 'color' => 'green'],
            ['route' => 'admin.category.index', 'icon' => 'fa-tags', 'label' => 'Kategori', 'color' => 'yellow'],
            ['route' => 'admin.suppliers.index', 'icon' => 'fa-truck', 'label' => 'Supplier', 'color' => 'purple'],
            ['route' => 'admin.users.index', 'icon' => 'fa-user', 'label' => 'Kelola User', 'color' => 'black'],
        ];
    } elseif ($role === 'manajer') {
        $navItems = [
            ['route' => 'manajer.dashboard', 'icon' => 'fa-tachometer-alt', 'label' => 'Dashboard', 'color' => 'blue'],
            ['route' => 'manajer.barang_masuk.index', 'icon' => 'fa-arrow-down', 'label' => 'Barang Masuk', 'color' => 'cyan'],
            ['route' => 'manajer.barang_keluar.index', 'icon' => 'fa-arrow-up', 'label' => 'Barang Keluar', 'color' => 'red'],
            ['route' => 'manajer.product.index', 'icon' => 'fa-box', 'label' => 'Stok Produk', 'color' => 'green'],
            ['route' => 'manajer.stock_opname.index', 'icon' => 'fa-clipboard-check', 'label' => 'Stok Opname', 'color' => 'yellow'],
        ];
    } elseif ($role === 'staff') {
        $navItems = [
            ['route' => 'staff.dashboard', 'icon' => 'fa-tachometer-alt', 'label' => 'Dashboard', 'color' => 'blue'],
            ['route' => 'staff.stock_opname.index', 'icon' => 'fa-clipboard-check', 'label' => 'Stock Opname', 'color' => 'yellow'],
        ];
    }
@endphp

<div class="w-64 bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900 shadow-2xl min-h-screen relative overflow-hidden">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.03\"%3E%3Ccircle cx=\"30\" cy=\"30\" r=\"4\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>

    <div class="relative z-10 p-6 border-b border-slate-700/50">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                <i class="fas fa-cube text-white text-lg"></i>
            </div>
            <div>
                <h2 class="text-white font-bold text-lg">{{ ucfirst($role) }} Panel</h2>
                <p class="text-slate-400 text-xs">Inventory Management</p>
            </div>
        </div>
    </div>

    <nav class="relative z-10 p-4 space-y-2">
        <ul class="space-y-1">
            @foreach ($navItems as $item)
                <li>
                    <a href="{{ route($item['route']) }}"
                       class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 border border-transparent
                           {{ Route::is($item['route'].'*') ? 'bg-'.$item['color'].'-500/20 text-white border-'.$item['color'].'-500/30 shadow-md' : 'text-slate-300 hover:text-white hover:bg-'.$item['color'].'-500/10 hover:border-'.$item['color'].'-500/30 hover:shadow-lg' }}">
                        <div class="w-8 h-8 bg-slate-700 group-hover:bg-{{ $item['color'] }}-500 rounded-lg flex items-center justify-center transition-all duration-200 group-hover:scale-110">
                            <i class="fas {{ $item['icon'] }} text-sm"></i>
                        </div>
                        <span class="font-medium">{{ $item['label'] }}</span>
                        @if (Route::is($item['route'].'*'))
                            <div class="ml-auto">
                                <i class="fas fa-chevron-right text-xs text-white"></i>
                            </div>
                        @else
                            <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity">
                                <i class="fas fa-chevron-right text-xs"></i>
                            </div>
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>

    <div class="relative z-10 mx-4 my-4 border-t border-slate-700/50"></div>

    <div class="relative z-10 p-4">
        <div class="bg-slate-800/50 rounded-xl p-4 border border-slate-700/50">
            <div class="flex items-center space-x-3 mb-3">
                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-white text-sm"></i>
                </div>
                <div>
                    <p class="text-white font-medium text-sm">{{ Auth::user()->name ?? ucfirst($role) }}</p>
                    <p class="text-slate-400 text-xs">{{ Auth::user()->email ?? $role.'@example.com' }}</p>
                </div>
            </div>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="group flex items-center gap-3 px-3 py-2 text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded-lg transition-all duration-200 border border-transparent hover:border-red-500/30 w-full">
                <div class="w-6 h-6 bg-red-500/20 group-hover:bg-red-500/30 rounded-md flex items-center justify-center transition-all duration-200">
                    <i class="fas fa-sign-out-alt text-xs"></i>
                </div>
                <span class="font-medium text-sm">Keluar</span>
            </a>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-slate-900 to-transparent pointer-events-none"></div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>
</div>