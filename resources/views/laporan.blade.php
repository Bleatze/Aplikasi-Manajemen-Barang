@extends('layouts.main')

@section('title', 'Laporan')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Laporan Barang</h1>

    {{-- Filter Tanggal --}}
    <div class=" p-4 mb-6">
        <form class="grid md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm mb-1">Tanggal Mulai</label>
                <input type="date" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm mb-1">Tanggal Selesai</label>
                <input type="date" class="w-full border rounded px-3 py-2">
            </div>
            <button class=" bg-purple-500 hover:bg-purple-600 text-white mt-6 py-2 rounded col-span-full md:col-span-1">
                Tampilkan
            </button>
        </form>
    </div>

    {{-- Tabel Laporan --}}
    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="min-w-full text-sm text-left">
             <thead class="bg-gray-300">
                <tr>
                    <th class="px-4 py-3">Tanggal</th>
                    <th class="px-4 py-3">Jenis</th>
                    <th class="px-4 py-3">Barang</th>
                    <th class="px-4 py-3">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b">
                    <td class="px-4 py-2">2025-06-30</td>
                    <td class="px-4 py-2">Masuk</td>
                    <td class="px-4 py-2">Pulpen</td>
                    <td class="px-4 py-2">20</td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-2">2025-06-30</td>
                    <td class="px-4 py-2">Keluar</td>
                    <td class="px-4 py-2">Kertas</td>
                    <td class="px-4 py-2">10</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
