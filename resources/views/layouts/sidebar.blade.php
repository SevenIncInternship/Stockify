<div class="w-64 bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900 shadow-2xl min-h-screen relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.03"%3E%3Ccircle cx="30" cy="30" r="4"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
    
    <!-- Header -->
    <div class="relative z-10 p-6 border-b border-slate-700/50">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                <i class="fas fa-cube text-white text-lg"></i>
            </div>
            <div>
                <h2 class="text-white font-bold text-lg">Admin Panel</h2>
                <p class="text-slate-400 text-xs">Inventory Management</p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="relative z-10 p-4 space-y-2">
        <ul class="space-y-1">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-3 px-4 py-3 text-slate-300 hover:text-white hover:bg-gradient-to-r hover:from-blue-500/20 hover:to-purple-500/20 rounded-xl transition-all duration-200 border border-transparent hover:border-blue-500/30 hover:shadow-lg hover:shadow-blue-500/10">
                    <div class="w-8 h-8 bg-slate-700 group-hover:bg-blue-500 rounded-lg flex items-center justify-center transition-all duration-200 group-hover:scale-110">
                        <i class="fas fa-tachometer-alt text-sm"></i>
                    </div>
                    <span class="font-medium">Dashboard</span>
                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity">
                        <i class="fas fa-chevron-right text-xs"></i>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.product.index') }}" class="group flex items-center gap-3 px-4 py-3 text-slate-300 hover:text-white hover:bg-gradient-to-r hover:from-green-500/20 hover:to-emerald-500/20 rounded-xl transition-all duration-200 border border-transparent hover:border-green-500/30 hover:shadow-lg hover:shadow-green-500/10">
                    <div class="w-8 h-8 bg-slate-700 group-hover:bg-green-500 rounded-lg flex items-center justify-center transition-all duration-200 group-hover:scale-110">
                        <i class="fas fa-box text-sm"></i>
                    </div>
                    <span class="font-medium">Produk</span>
                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity">
                        <i class="fas fa-chevron-right text-xs"></i>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.barang_masuk.index') }}" class="group flex items-center gap-3 px-4 py-3 text-slate-300 hover:text-white hover:bg-gradient-to-r hover:from-cyan-500/20 hover:to-blue-500/20 rounded-xl transition-all duration-200 border border-transparent hover:border-cyan-500/30 hover:shadow-lg hover:shadow-cyan-500/10">
                    <div class="w-8 h-8 bg-slate-700 group-hover:bg-cyan-500 rounded-lg flex items-center justify-center transition-all duration-200 group-hover:scale-110">
                        <i class="fas fa-arrow-down text-sm"></i>
                    </div>
                    <span class="font-medium">Barang Masuk</span>
                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity">
                        <i class="fas fa-chevron-right text-xs"></i>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.barang_keluar.index') }}" class="group flex items-center gap-3 px-4 py-3 text-slate-300 hover:text-white hover:bg-gradient-to-r hover:from-red-500/20 hover:to-pink-500/20 rounded-xl transition-all duration-200 border border-transparent hover:border-red-500/30 hover:shadow-lg hover:shadow-red-500/10">
                    <div class="w-8 h-8 bg-slate-700 group-hover:bg-red-500 rounded-lg flex items-center justify-center transition-all duration-200 group-hover:scale-110">
                        <i class="fas fa-arrow-up text-sm"></i>
                    </div>
                    <span class="font-medium">Barang Keluar</span>
                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity">
                        <i class="fas fa-chevron-right text-xs"></i>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.category.index') }}" class="group flex items-center gap-3 px-4 py-3 text-slate-300 hover:text-white hover:bg-gradient-to-r hover:from-yellow-500/20 hover:to-orange-500/20 rounded-xl transition-all duration-200 border border-transparent hover:border-yellow-500/30 hover:shadow-lg hover:shadow-yellow-500/10">
                    <div class="w-8 h-8 bg-slate-700 group-hover:bg-yellow-500 rounded-lg flex items-center justify-center transition-all duration-200 group-hover:scale-110">
                        <i class="fas fa-tags text-sm"></i>
                    </div>
                    <span class="font-medium">Kategori</span>
                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity">
                        <i class="fas fa-chevron-right text-xs"></i>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.suppliers.index') }}" class="group flex items-center gap-3 px-4 py-3 text-slate-300 hover:text-white hover:bg-gradient-to-r hover:from-purple-500/20 hover:to-indigo-500/20 rounded-xl transition-all duration-200 border border-transparent hover:border-purple-500/30 hover:shadow-lg hover:shadow-purple-500/10">
                    <div class="w-8 h-8 bg-slate-700 group-hover:bg-purple-500 rounded-lg flex items-center justify-center transition-all duration-200 group-hover:scale-110">
                        <i class="fas fa-truck text-sm"></i>
                    </div>
                    <span class="font-medium">Supplier</span>
                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity">
                        <i class="fas fa-chevron-right text-xs"></i>
                    </div>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Divider -->
    <div class="relative z-10 mx-4 my-4 border-t border-slate-700/50"></div>

    <!-- User Profile Section -->
    <div class="relative z-10 p-4">
        <div class="bg-slate-800/50 rounded-xl p-4 border border-slate-700/50">
            <div class="flex items-center space-x-3 mb-3">
                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-white text-sm"></i>
                </div>
                <div>
                    <p class="text-white font-medium text-sm">Administrator</p>
                    <p class="text-slate-400 text-xs">admin@example.com</p>
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

    <!-- Bottom Decoration -->
    <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-slate-900 to-transparent pointer-events-none"></div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>
</div>