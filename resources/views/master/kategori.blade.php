@extends('layouts.main')

@section('title', 'Data Kategori')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Data Kategori</h1>

    {{-- Form Tambah Kategori --}}
    <div class="bg-white p-4 rounded shadow mb-6">
        <form class="space-y-4 md:flex md:items-end md:space-x-4 md:space-y-0">
            <div class="w-full md:w-1/3">
                <label class="block text-sm font-medium mb-1">Nama Kategori</label>
                <input type="text" class="w-full border-gray-300 rounded px-3 py-2 shadow-sm" placeholder="Masukkan nama kategori">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Tambah
            </button>
        </form>
    </div>

    {{-- Tabel Kategori --}}
    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Nama Kategori</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b">
                    <td class="px-4 py-2">1</td>
                    <td class="px-4 py-2">Alat Tulis</td>
                    <td class="px-4 py-2 text-center space-x-2">
                        <input type="text" class="border px-2 py-1 rounded w-32" value="Alat Tulis">
                        <button class="bg-yellow-400 px-2 py-1 text-white rounded hover:bg-yellow-500">Update</button>
                        <button class="bg-red-500 px-2 py-1 text-white rounded hover:bg-red-600">Hapus</button>
                    </td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-2">2</td>
                    <td class="px-4 py-2">Elektronik</td>
                    <td class="px-4 py-2 text-center space-x-2">
                        <input type="text" class="border px-2 py-1 rounded w-32" value="Elektronik">
                        <button class="bg-yellow-400 px-2 py-1 text-white rounded hover:bg-yellow-500">Update</button>
                        <button class="bg-red-500 px-2 py-1 text-white rounded hover:bg-red-600">Hapus</button>
                    </td>
                </tr>
                <tr>
                    <td class="px-4 py-2">3</td>
                    <td class="px-4 py-2">ATK</td>
                    <td class="px-4 py-2 text-center space-x-2">
                        <input type="text" class="border px-2 py-1 rounded w-32" value="ATK">
                        <button class="bg-yellow-400 px-2 py-1 text-white rounded hover:bg-yellow-500">Update</button>
                        <button class="bg-red-500 px-2 py-1 text-white rounded hover:bg-red-600">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
