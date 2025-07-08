@extends('layouts.main')

@section('title', 'Data Satuan')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Data Satuan</h1>

    {{-- Form Tambah Satuan --}}
    <div class="bg-white p-4 rounded shadow mb-6">
        <form class="space-y-4 md:flex md:items-end md:space-x-4 md:space-y-0">
            <div class="w-full md:w-1/3">
                <label class="block text-sm font-medium mb-1">Nama Satuan</label>
                <input type="text" name="nama" class="w-full border-gray-300 rounded px-3 py-2 shadow-sm" placeholder="Contoh: Pcs, Liter, Kg">
            </div>
            <button type="submit" class="bg-primary text-white px-4 py-2 rounded hover:bg-kk">
                Tambah
            </button>
        </form>
    </div>

    {{-- Tabel Satuan --}}
    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Nama Satuan</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- Contoh data statis --}}
                @for ($i = 1; $i <= 3; $i++)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $i }}</td>
                        <td class="px-4 py-2">Pcs</td>
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
