@extends('layouts.app')

@section('title', 'Kelola Pengguna')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar Pengguna</h2>

    @if (session('success'))
        <div class="p-3 bg-green-100 text-green-700 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full text-xs table-auto">
        <thead class="bg-gray-50">
            <tr class="border-b">
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Role</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr class="border-b">
                <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $user->role }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="flex items-center gap-2">
                        @csrf
                        @method('PUT') <!-- penting untuk spoof PUT method -->
                        <select name="role" class="border rounded px-2 py-1">
                            <option value="admin" @selected($user->role === 'admin')>Admin</option>
                            <option value="manajer" @selected($user->role === 'manajer')>Manajer</option>
                            <option value="staff" @selected($user->role === 'staff')>Staff</option>
                        </select>
                        <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Update</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
@endsection