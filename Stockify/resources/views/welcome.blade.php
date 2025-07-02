@extends('layouts.app')

@section('content')
<div class="min-h-screen h-full w-auto flex flex-col items-center justify-center bg-gradient-to-r from-gray-200 to-white text-black text-center">
    <div>
        <img src="{{ asset('assets/images/contoh.jpg') }}" alt="Logo" class="mx-auto max-w-md w-full h-auto float-none shadow-md">
    </div>
    <div class="">
        <h1 class="text-4xl md:text-6xl font-extrabold mb-4">Selamat Datang di Stockify</h1>
        <p class="text-lg md:text-xl mb-6">Kelola stok barangmu dengan mudah dan cepat.</p>
    </div>

    <div class="space-x-4">
        <a href="{{ route('login') }}"
           class="bg-gray-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-gray-200 transition">
            Get Started
        </a>
    </div>
</div>
@endsection
