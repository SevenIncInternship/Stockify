<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Home') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])


    {{-- Tambahan font atau meta tag bisa di sini --}}
</head>
<body class="font-sans antialiased">
     @include('layouts.navbar')

    {{-- Flash message (jika ada) --}}
    @if (session('status'))
        <div class="bg-green-100 text-green-800 px-4 py-2 text-sm text-center">
            {{ session('status') }}
        </div>
    @endif

    {{-- Konten halaman --}}
    <main class="container">
        @yield('content')
    </main>

</body>
</html>
