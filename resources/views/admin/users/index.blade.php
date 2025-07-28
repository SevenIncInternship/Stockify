@extends('layouts.app')

@section('title', 'Kelola Pengguna')

@section('content')
<div class="container max-w-screen-xl mx-auto p-6">

    {{-- Notifikasi sukses --}}
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Header --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Kelola Pengguna</h2>
        <p class="text-sm text-gray-500">Ubah peran pengguna dalam sistem</p>
    </div>

    {{-- Tabel --}}
    <div class="overflow-x-auto bg-white rounded shadow border border-gray-200">
        <table class="min-w-full table-auto text-sm text-gray-700">
            <thead class="bg-gray-50 text-xs font-semibold uppercase text-gray-600">
                <tr>
                    <th class="px-6 py-3 text-left">Nama</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Role</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap capitalize">{{ $user->role }}</td>
                        <td class="px-6 py-4 text-center">
                            <form method="POST" action="{{ route('admin.users.update', $user->id) }}"
                                  class="flex justify-center items-center gap-3">
                                @csrf
                                @method('PUT')
                                <select name="role" class="border-gray-300 rounded-lg px-2 py-1 text-sm focus:ring focus:ring-blue-200">
                                    <option value="admin" @selected($user->role === 'admin')>Admin</option>
                                    <option value="manajer" @selected($user->role === 'manajer')>Manajer</option>
                                    <option value="staff" @selected($user->role === 'staff')>Staff</option>
                                </select>
                                <button type="submit"
                                        class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1 rounded shadow">
                                    Update
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if ($users->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center px-6 py-4 text-gray-500">Tidak ada pengguna ditemukan.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection