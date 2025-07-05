<header class="bg-white shadow-md">
    <div class="max-w-screen-xl mx-auto px-4 py-3 flex justify-between items-center">
        <div class="text-2xl font-bold text-gray-800">
            <a href="{{ route('dashboard') }}">Stockify</a>
        </div>

        {{-- Hamburger toggle for mobile --}}
        <div class="md:hidden">
            <button id="menu-toggle" class="text-gray-600 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <nav class="hidden md:flex space-x-6 text-gray-700 font-medium items-center" id="main-menu">
            <a href="{{ route('produk.index') }}" class="hover:text-blue-600">Produk</a>
            <a href="{{ route('stok.index') }}" class="hover:text-blue-600">Stok</a>
            <a href="{{ route('laporan.index') }}" class="hover:text-blue-600">Laporan</a>

            @if(auth()->user()->role === 'admin')
                <a href="{{ route('kategori.index') }}" class="hover:text-blue-600">Kategori</a>
                <a href="{{ route('supplier.index') }}" class="hover:text-blue-600">Supplier</a>
                <a href="{{ route('pengguna.index') }}" class="hover:text-blue-600">Pengguna</a>
            @endif

            @if(auth()->user()->role === 'manajer')
                <a href="{{ route('masuk.index') }}" class="hover:text-blue-600">Barang Masuk</a>
                <a href="{{ route('keluar.index') }}" class="hover:text-blue-600">Barang Keluar</a>
                <a href="{{ route('opname.index') }}" class="hover:text-blue-600">Stock Opname</a>
            @endif

            @if(auth()->user()->role === 'staff')
                <a href="{{ route('masuk.index') }}" class="hover:text-blue-600">Barang Masuk</a>
                <a href="{{ route('keluar.index') }}" class="hover:text-blue-600">Barang Keluar</a>
            @endif

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-red-600 hover:underline">Logout</button>
            </form>
        </nav>
    </div>

    {{-- Mobile Menu --}}
    <div class="md:hidden hidden px-4 pb-4" id="mobile-menu">
        <a href="{{ route('produk.index') }}" class="block py-2 text-gray-700">Produk</a>
        <a href="{{ route('stok.index') }}" class="block py-2 text-gray-700">Stok</a>
        <a href="{{ route('laporan.index') }}" class="block py-2 text-gray-700">Laporan</a>

        @if(auth()->user()->role === 'admin')
            <a href="{{ route('kategori.index') }}" class="block py-2 text-gray-700">Kategori</a>
            <a href="{{ route('supplier.index') }}" class="block py-2 text-gray-700">Supplier</a>
            <a href="{{ route('pengguna.index') }}" class="block py-2 text-gray-700">Pengguna</a>
        @endif

        @if(auth()->user()->role === 'manajer')
            <a href="{{ route('masuk.index') }}" class="block py-2 text-gray-700">Barang Masuk</a>
            <a href="{{ route('keluar.index') }}" class="block py-2 text-gray-700">Barang Keluar</a>
            <a href="{{ route('opname.index') }}" class="block py-2 text-gray-700">Stock Opname</a>
        @endif

        @if(auth()->user()->role === 'staff')
            <a href="{{ route('masuk.index') }}" class="block py-2 text-gray-700">Barang Masuk</a>
            <a href="{{ route('keluar.index') }}" class="block py-2 text-gray-700">Barang Keluar</a>
        @endif

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-red-600 py-2">Logout</button>
        </form>
    </div>

    <script>
        // Toggle mobile menu
        document.addEventListener('DOMContentLoaded', function () {
            const toggle = document.getElementById('menu-toggle');
            const menu = document.getElementById('mobile-menu');

            toggle.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        });
    </script>
</header>
