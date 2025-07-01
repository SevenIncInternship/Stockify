<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Load Tailwind via Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Tambahan font atau meta tag bisa di sini --}}
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased">

    {{-- Flash message (jika ada) --}}
    @if (session('status'))
        <div class="bg-green-100 text-green-800 px-4 py-2 text-sm text-center">
            {{ session('status') }}
        </div>
    @endif

    {{-- Konten halaman --}}
    <main class="py-6">
        @yield('content')
    </main>

</body>
</html>
