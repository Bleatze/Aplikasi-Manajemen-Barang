@extends('layouts.main')

@section('title', 'Manajemen User')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Manajemen User</h1>

    {{-- Form Tambah User --}}
    <div class="bg-white p-4 rounded shadow mb-6">
        <form class="grid md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm mb-1">Nama</label>
                <input type="text" class="w-full border rounded px-3 py-2" placeholder="Nama Lengkap">
            </div>
            <div>
                <label class="block text-sm mb-1">Email</label>
                <input type="email" class="w-full border rounded px-3 py-2" placeholder="Email">
            </div>
            <div>
                <label class="block text-sm mb-1">Password</label>
                <input type="password" class="w-full border rounded px-3 py-2" placeholder="Password">
            </div>
            <button class="bg-blue-600 text-white mt-6 py-2 rounded hover:bg-blue-700 col-span-full md:col-span-1">
                Tambah User
            </button>
        </form>
    </div>

    {{-- Tabel User --}}
    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Peran</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 3; $i++)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $i }}</td>
                        <td class="px-4 py-2">User {{ $i }}</td>
                        <td class="px-4 py-2">user{{ $i }}@example.com</td>
                        <td class="px-4 py-2">Admin</td>
                        <td class="px-4 py-2 text-center space-x-2">
                            <button class="bg-yellow-400 px-2 py-1 text-white rounded hover:bg-yellow-500">Edit</button>
                            <button class="bg-red-500 px-2 py-1 text-white rounded hover:bg-red-600">Hapus</button>
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
@endsection
