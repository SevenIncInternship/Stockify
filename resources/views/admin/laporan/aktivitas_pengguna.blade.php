@extends('layouts.app')

@section('title', 'Laporan Aktivitas Pengguna')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Laporan Aktivitas Pengguna</h2>

    <a href="{{ route('admin.laporan.aktivitasPengguna.pdf') }}" class="btn btn-primary mb-4">Unduh Laporan PDF</a>

    <table class="table-auto w-full">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pengguna</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $i => $user)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
