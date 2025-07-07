@extends('layouts.main')
@section('title', 'Dashboard')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Dashboard</h1>
<style>
#notifKritis {
    position: fixed;
    bottom: 20px;
    right: 20px;
    max-width: 300px;
    z-index: 50;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, opacity 0.3s ease;
}
@keyframes fadeInNotif {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade {
    animation: fadeInNotif 0.3s ease-out;
}
.animate-out {
    animation: fadeOutNotif 0.3s ease-out forwards;
}
@keyframes fadeOutNotif {
    from { opacity: 1; transform: translateY(0); }
    to { opacity: 0; transform: translateY(10px); }
}
</style>

@php
$barangList = [
    ['nama' => 'Keyboard Logitech', 'stok' => 25],
    ['nama' => 'Mouse Wireless', 'stok' => 8],
    ['nama' => 'Kabel LAN 5M', 'stok' => 3],
    ['nama' => 'Harddisk 1TB', 'stok' => 15],
    ['nama' => 'Monitor LED 24"', 'stok' => 40],
    ['nama' => 'Ram Stick 8GB', 'stok' => 5],
    ['nama' => 'Mousepad', 'stok' => 1],
];

foreach ($barangList as &$barang) {
    if ($barang['stok'] <= 5) {
        $barang['status'] = 'Kritis';
        $barang['warna'] = 'bg-red-100 text-red-700';
        $barang['statusValue'] = 'kritis';
    } elseif ($barang['stok'] <= 20) {
        $barang['status'] = 'Menipis';
        $barang['warna'] = 'bg-yellow-100 text-yellow-700';
        $barang['statusValue'] = 'menipis';
    } else {
        $barang['status'] = 'Aman';
        $barang['warna'] = 'bg-green-100 text-green-700';
        $barang['statusValue'] = 'aman';
    }
}
unset($barang);
$barangKritis = array_filter($barangList, fn($b) => $b['statusValue'] === 'kritis');
@endphp

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-white p-4 rounded shadow">
        <p class="text-gray-500">Total Barang</p>
        <p class="text-xl font-bold">{{ array_sum($barangMasuk['2025']) }}</p>
    </div>
    <div class="bg-white p-4 rounded shadow">
        <p class="text-gray-500">Barang Masuk Bulan Ini</p>
        <p class="text-xl font-bold">{{ end($barangMasuk['2025']) }}</p>
    </div>
    <div class="bg-white p-4 rounded shadow">
        <p class="text-gray-500">Barang Keluar Bulan Ini</p>
        <p class="text-xl font-bold">{{ end($barangKeluar['2025']) }}</p>
    </div>
</div>

<div id="notifKritis" class="bg-white p-4 rounded shadow animate-fade relative">
    <div class="flex justify-between items-center mb-2">
        <h2 class="text-md font-semibold text-red-600 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-1.414-1.414L12 9.172 7.05 4.222 5.636 5.636 10.586 10.586 5.636 15.536l1.414 1.414L12 12.828l4.95 4.95 1.414-1.414L13.414 10.586 18.364 5.636z" />
            </svg>
            Barang Kritis
        </h2>
        <div class="flex items-center gap-2">
            <button id="minimizeNotif" class="text-red-500 hover:text-red-700 text-sm px-2">–</button>
            <button id="closeNotif" class="text-red-500 hover:text-red-700 text-sm px-2">×</button>
        </div>
    </div>
    <div id="notifContent">
        @if(count($barangKritis) > 0)
        <ul class="text-sm text-gray-700">
            @foreach ($barangKritis as $barang)
            <li class="border-b py-1 flex justify-between">
                <span>{{ $barang['nama'] }}</span>
                <span class="font-semibold text-red-600">{{ $barang['stok'] }}</span>
            </li>
            @endforeach
        </ul>
        @else
        <p class="text-green-600">Semua stok dalam kondisi aman.</p>
        @endif
    </div>
</div>


<div class="bg-white p-4 rounded shadow mt-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-2">
        <h2 class="text-lg font-semibold">Trend Barang Masuk & Keluar</h2>
        <div class="flex items-center gap-2">
            <label for="filterTahun" class="text-gray-600">Tahun:</label>
            <select id="filterTahun" class="border border-gray-300 rounded px-3 py-2 shadow-sm">
                <option value="2025">2025</option>
                <option value="2024">2024</option>
                <option value="2023">2023</option>
            </select>
        </div>
    </div>
    <canvas id="barangLineChart" height="150"></canvas>
</div>

<div class="bg-white p-4 rounded shadow mt-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-2">
        
        <!-- Judul di kiri -->
        <h2 class="text-lg font-semibold">Status Stok Barang</h2>
        
        <!-- Search & Filter di kanan -->
        <div class="flex items-center gap-2">

            <!-- Search dengan icon & lonjong -->
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                    </svg>
                </span>
                <input type="text" id="searchInput" placeholder="Cari Barang..." class="pl-10 pr-3 py-2 border border-gray-300 rounded-full shadow-sm focus:outline-none w-48">
            </div>

            <!-- Filter Status dengan icon & lonjong -->
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707l-7 7V20l-4-2v-6.293l-7-7A1 1 0 013 4z" />
                    </svg>
                </span>
                <select id="filterStatus" class="pl-10 pr-3 py-2 border border-gray-300 rounded-full shadow-sm w-48">
                    <option value="semua">Semua Status</option>
                    <option value="aman">Aman</option>
                    <option value="menipis">Menipis</option>
                    <option value="kritis">Kritis</option>
                </select>
            </div>

        </div>
    </div>

    <!-- Tabel Stok Barang -->
    <table class="w-full text-left border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">Nama Barang</th>
                <th class="p-2 border">Stok</th>
                <th class="p-2 border">Status</th>
            </tr>
        </thead>
        <tbody id="barangTable">
            @foreach ($barangList as $barang)
            <tr data-status="{{ $barang['statusValue'] }}" data-nama="{{ strtolower($barang['nama']) }}">
                <td class="p-2 border">{{ $barang['nama'] }}</td>
                <td class="p-2 border">{{ $barang['stok'] }}</td>
                <td class="p-2 border">
                    <span class="px-2 py-1 rounded {{ $barang['warna'] }} text-sm">{{ $barang['status'] }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('barangLineChart').getContext('2d');
const filterTahun = document.getElementById('filterTahun');

const datasetByYear = {
    '2025': { labels: @json($labels['2025']), masuk: @json($barangMasuk['2025']), keluar: @json($barangKeluar['2025']) },
    '2024': { labels: @json($labels['2024']), masuk: @json($barangMasuk['2024']), keluar: @json($barangKeluar['2024']) },
    '2023': { labels: @json($labels['2023']), masuk: @json($barangMasuk['2023']), keluar: @json($barangKeluar['2023']) },
};

let chart;
function renderChart(tahun) {
    const data = datasetByYear[tahun];
    if (!data) return;

    if (chart) chart.destroy();

    const gradientMasuk = ctx.createLinearGradient(0, 0, 0, 200);
    gradientMasuk.addColorStop(0, 'rgba(59, 130, 246, 0.3)');
    gradientMasuk.addColorStop(1, 'rgba(59, 130, 246, 0)');

    const gradientKeluar = ctx.createLinearGradient(0, 0, 0, 200);
    gradientKeluar.addColorStop(0, 'rgba(249, 115, 22, 0.3)');
    gradientKeluar.addColorStop(1, 'rgba(249, 115, 22, 0)');

    chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: data.labels,
            datasets: [
                { label: 'Barang Masuk', data: data.masuk, borderColor: '#3b82f6', backgroundColor: gradientMasuk, tension: 0.4, fill: true },
                { label: 'Barang Keluar', data: data.keluar, borderColor: '#f97316', backgroundColor: gradientKeluar, tension: 0.4, fill: true }
            ]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true } }, plugins: { legend: { position: 'bottom' } } }
    });
}

renderChart(filterTahun.value);
filterTahun.addEventListener('change', () => renderChart(filterTahun.value));

const filterStatus = document.getElementById('filterStatus');
const searchInput = document.getElementById('searchInput');
const rows = document.querySelectorAll('#barangTable tr');

function filterTable() {
    const status = filterStatus.value;
    const search = searchInput.value.toLowerCase();
    rows.forEach(row => {
        const rowStatus = row.dataset.status;
        const rowNama = row.dataset.nama;
        const visible = (status === 'semua' || rowStatus === status) && rowNama.includes(search);
        row.style.display = visible ? '' : 'none';
    });
}

filterStatus.addEventListener('change', filterTable);
searchInput.addEventListener('keyup', filterTable);

document.getElementById('minimizeNotif').onclick = () => {
    const content = document.getElementById('notifContent');
    const btn = document.getElementById('minimizeNotif');
    if (content.classList.contains('hidden')) {
        content.classList.remove('hidden');
        btn.textContent = '–';
    } else {
        content.classList.add('hidden');
        btn.textContent = '+';
    }
};

document.getElementById('closeNotif').onclick = () => {
    const notif = document.getElementById('notifKritis');
    notif.classList.remove('animate-fade');
    notif.classList.add('animate-out');
    notif.addEventListener('animationend', () => notif.remove(), { once: true });
};
</script>
@endsection
