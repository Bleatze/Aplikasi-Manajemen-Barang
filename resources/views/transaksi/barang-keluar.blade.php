@extends('layouts.main')

@section('title', 'Barang Keluar')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Barang Keluar</h1>

    {{-- Form Tambah Barang Keluar --}}
    <div class="bg-white p-4 rounded shadow mb-6">
        <form class="grid md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm mb-1">Tanggal</label>
                <input type="date" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm mb-1">Barang</label>
                <select class="w-full border rounded px-3 py-2">
                    <option>Pulpen</option>
                    <option>Kertas</option>
                </select>
            </div>
            <div>
                <label class="block text-sm mb-1">Jumlah</label>
                <input type="number" class="w-full border rounded px-3 py-2" placeholder="0">
            </div>
            <button class="bg-blue-600 text-white mt-6 py-2 rounded hover:bg-blue-700 col-span-full md:col-span-1">
                Tambah
            </button>
        </form>
    </div>

    {{-- Tabel Barang Keluar --}}
    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3">Tanggal</th>
                    <th class="px-4 py-3">Barang</th>
                    <th class="px-4 py-3">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b">
                    <td class="px-4 py-2">2025-06-30</td>
                    <td class="px-4 py-2">Kertas</td>
                    <td class="px-4 py-2">10</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
