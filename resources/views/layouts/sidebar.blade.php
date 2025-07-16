@php
    $user = Auth::user();
    $prefix = '';
    $navItems = [];

    if ($user->role === 'admin') {
        $prefix = 'admin.';
        $navItems = [
            ['route' => 'dashboard', 'icon' => 'fa-home', 'label' => 'Dashboard', 'color' => 'blue'],
            ['route' => 'product.index', 'icon' => 'fa-box', 'label' => 'Produk', 'color' => 'green'],
            ['route' => 'barang_masuk.index', 'icon' => 'fa-arrow-down', 'label' => 'Barang Masuk', 'color' => 'cyan'],
            ['route' => 'barang_keluar.index', 'icon' => 'fa-arrow-up', 'label' => 'Barang Keluar', 'color' => 'red'],
            ['route' => 'category.index', 'icon' => 'fa-tags', 'label' => 'Kategori', 'color' => 'yellow'],
            ['route' => 'suppliers.index', 'icon' => 'fa-truck', 'label' => 'Supplier', 'color' => 'purple'],
            ['route' => 'users.index', 'icon' => 'fa-user', 'label' => 'User', 'color' => 'pink'],
        ];
    } elseif ($user->role === 'manajer') {
        $prefix = 'manajer.';
        $navItems = [
            ['route' => 'dashboard', 'icon' => 'fa-home', 'label' => 'Dashboard', 'color' => 'blue'],
            ['route' => 'barang_masuk.index', 'icon' => 'fa-arrow-down', 'label' => 'Barang Masuk', 'color' => 'green'],
            ['route' => 'barang_keluar.index', 'icon' => 'fa-arrow-up', 'label' => 'Barang Keluar', 'color' => 'red'],
            ['route' => 'stock_opname.index', 'icon' => 'fa-clipboard-check', 'label' => 'Stock Opname', 'color' => 'orange'],
        ];
    } elseif ($user->role === 'staff') {
        $prefix = 'staff.';
        $navItems = [
            ['route' => 'dashboard', 'icon' => 'fa-home', 'label' => 'Dashboard', 'color' => 'blue'],
            ['route' => 'barang_masuk.index', 'icon' => 'fa-arrow-down', 'label' => 'Barang Masuk', 'color' => 'green'],
            ['route' => 'barang_keluar.index', 'icon' => 'fa-arrow-up', 'label' => 'Barang Keluar', 'color' => 'red'],
        ];
    }
@endphp

<ul class="space-y-2 mt-6">
    @foreach ($navItems as $item)
        @php
            $fullRoute = $prefix . $item['route'];
            $isActive = Route::is($fullRoute);
        @endphp
        <li>
            <a href="{{ route($fullRoute) }}"
               class="flex items-center px-4 py-3 rounded-lg transition-all duration-200
               {{ $isActive ? 'bg-'.$item['color'].'-100 text-'.$item['color'].'-700 font-semibold' : 'text-gray-500 hover:bg-'.$item['color'].'-50 hover:text-'.$item['color'].'-600' }}">
                
                {{-- Ikon bulat --}}
                <div class="w-9 h-9 rounded-full flex items-center justify-center mr-3
                    {{ $isActive ? 'bg-'.$item['color'].'-500 text-white' : 'bg-'.$item['color'].'-100 text-'.$item['color'].'-600' }}">
                    <i class="fas {{ $item['icon'] }} text-sm"></i>
                </div>

                <span class="text-sm">{{ $item['label'] }}</span>

                {{-- Panah kanan hanya saat aktif --}}
                @if($isActive)
                    <i class="fas fa-chevron-right ml-auto text-xs text-{{ $item['color'] }}-600"></i>
                @endif
            </a>
        </li>
    @endforeach
</ul>