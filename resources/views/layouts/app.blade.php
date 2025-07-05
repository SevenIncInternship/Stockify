<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Stockify')</title>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen">

@auth
    <!-- Layout untuk user login -->
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Konten Utama -->
        <div class="flex-1 flex flex-col ml-64"> {{-- ml-64 karena sidebar width = w-64 --}}
            <!-- Navbar -->
            <nav class="bg-white shadow-md py-4 px-6 flex justify-between items-center">
                <div class="text-xl font-bold text-green-700">@yield('title', 'Dashboard')</div>
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

            <!-- Konten -->
            <main class="flex-1 w-full px-6 py-6"> {{-- ✅ PERBAIKAN DI SINI --}}
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-white shadow-inner py-4 text-center text-sm text-gray-500 mt-auto">
                &copy; {{ date('Y') }} Stockify Warehouse System. All rights reserved.
            </footer>
        </div>
    </div>
@else
    <!-- Layout untuk tamu -->
    <main class="min-h-screen flex items-center justify-center p-6">
        @yield('content')
    </main>
@endauth

</body>
</html>
