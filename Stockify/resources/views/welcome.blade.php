@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-r from-blue-500 to-purple-600 text-white text-center px-6">
    <h1 class="text-4xl md:text-6xl font-extrabold mb-4">Selamat Datang di Stockify</h1>
    <p class="text-lg md:text-xl mb-6">Kelola stok barangmu dengan mudah dan cepat.</p>
    <div class="space-x-4">
        <a href="{{ route('login') }}"
           class="bg-white text-blue-600 font-semibold px-6 py-2 rounded-lg hover:bg-gray-200 transition">
            Login
        </a>
    </div>
</div>
@endsection
