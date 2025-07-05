<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Stockify')</title>

    <!-- Vite Assets (untuk app.css dan app.js yang dikompilasi oleh Vite/TailwindCSS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome CDN untuk ikon (digunakan di sidebar dan mungkin di tempat lain) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen">

    @auth
        {{-- Layout untuk pengguna yang sudah login (dengan Sidebar dan Navbar) --}}
        <div class="flex min-h-screen"> {{-- Menggunakan flex untuk sidebar dan konten utama --}}
            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col ml-64"> {{-- ml-64 untuk mengimbangi lebar sidebar --}}
                <!-- Navbar / Header untuk konten utama -->
                <nav class="bg-white shadow-md py-4 px-6 flex justify-between items-center">
                    <div class="text-xl font-bold text-green-700">@yield('title', 'Dashboard')</div> {{-- Menampilkan judul halaman --}}
                    <div>
                        <span class="text-gray-700 mr-4">Selamat datang, <span class="font-semibold">{{ Auth::user()->name }}</span></span>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form-nav').submit();"
                           class="text-red-600 hover:underline">
                            Logout
                        </a>
                        <form id="logout-form-nav" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                </nav>

                <!-- Konten Utama Halaman -->
                <main class="flex-1 container mx-auto px-4 py-6">
                    @yield('content')
                </main>

                <!-- Footer -->
                <footer class="bg-white shadow-inner py-4 text-center text-sm text-gray-500 mt-auto">
                    &copy; {{ date('Y') }} Stockify Warehouse System. All rights reserved.
                </footer>
            </div>
        </div>
    @else
        {{-- Layout untuk pengguna tamu (tanpa Sidebar dan Navbar, konten di tengah) --}}
        <main class="min-h-screen flex items-center justify-center p-6">
            @yield('content')
        </main>
    @endauth

    <!-- Stack untuk skrip khusus halaman (misalnya, inisialisasi Chart.js) -->
    @stack('scripts')

</body>
</html>
