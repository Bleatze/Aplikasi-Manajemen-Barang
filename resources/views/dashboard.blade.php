@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded shadow">
            <p class="text-gray-500">Total Barang</p>
            <p class="text-xl font-bold">120</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <p class="text-gray-500">Barang Masuk</p>
            <p class="text-xl font-bold">45</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <p class="text-gray-500">Stok Menipis</p>
            <p class="text-xl font-bold text-red-500">5 Item</p>
        </div>
    </div>
@endsection
