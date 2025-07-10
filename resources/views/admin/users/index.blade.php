@extends('layouts.app')

@section('title', 'Kelola Pengguna')

@section('content')
<div class="p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Daftar Pengguna</h2>

    @if (session('success'))
        <div class="p-3 bg-green-100 text-green-700 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full text-sm text-left">
        <thead>
            <tr class="border-b">
                <th class="py-2">Nama</th>
                <th class="py-2">Email</th>
                <th class="py-2">Role</th>
                <th class="py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr class="border-b">
                <td class="py-2">{{ $user->name }}</td>
                <td class="py-2">{{ $user->email }}</td>
                <td class="py-2">{{ $user->role }}</td>
                <td class="py-2">
                    <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="flex items-center gap-2">
                        @csrf
                        @method('PUT') <!-- penting untuk spoof PUT method -->
                        <select name="role" class="border rounded px-2 py-1">
                            <option value="admin" @selected($user->role === 'admin')>Admin</option>
                            <option value="staff" @selected($user->role === 'staff')>Staff</option>
                            <option value="user" @selected($user->role === 'user')>User</option>
                        </select>
                        <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Update</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection