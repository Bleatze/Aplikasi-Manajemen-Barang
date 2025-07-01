@extends('layouts.main')

@section('title', 'Data Barang')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Data Barang</h1>

    <div class="bg-white p-4 rounded shadow mb-6">
        <form class="grid md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Nama Barang</label>
                <input type="text" class="w-full border-gray-300 rounded px-3 py-2 shadow-sm" placeholder="Contoh: Pulpen">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Kategori</label>
                <select class="w-full border-gray-300 rounded px-3 py-2 shadow-sm">
                    <option>Alat Tulis</option>
                    <option>Elektronik</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Satuan</label>
                <select class="w-full border-gray-300 rounded px-3 py-2 shadow-sm">
                    <option>Pcs</option>
                    <option>Box</option>
                </select>
            </div>
            <button class="bg-blue-600 text-white py-2 rounded hover:bg-blue-700 col-span-full">Tambah</button>
        </form>
    </div>

    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Kategori</th>
                    <th class="px-4 py-3">Satuan</th>
                    <th class="px-4 py-3">Stok</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 3; $i++)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $i }}</td>
                        <td class="px-4 py-2">Pulpen</td>
                        <td class="px-4 py-2">Alat Tulis</td>
                        <td class="px-4 py-2">Pcs</td>
                        <td class="px-4 py-2">50</td>
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
