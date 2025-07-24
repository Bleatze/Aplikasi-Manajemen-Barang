@extends('layouts.main')
@section('title', 'Dashboard')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Dashboard</h1>

    {{-- Ringkasan --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white p-4 rounded shadow">
            <p class="text-gray-500">Total Barang</p>
            <p class="text-xl font-bold">{{ $totalBarang }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <p class="text-gray-500">Barang Masuk Bulan Ini</p>
            <p class="text-xl font-bold">{{ $barangMasukBulanIni }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <p class="text-gray-500">Barang Keluar Bulan Ini</p>
            <p class="text-xl font-bold">{{ $barangKeluarBulanIni }}</p>
        </div>
    </div>

    {{-- Grafik --}}
    <div class="bg-white p-6 rounded shadow space-y-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Pie Chart Masuk --}}
            <div class="flex flex-col items-center justify-center h-[500px]">
                <h3 class="text-center text-gray-600 mb-2">Barang Masuk Bulan Ini</h3>
                <div class="aspect-square w-[500px]">
                    <canvas id="barangMasukPieChart" class="w-full h-full"></canvas>
                </div>
            </div>

            {{-- Pie Chart Keluar --}}
            <div class="flex flex-col items-center justify-center h-[500px]">
                <h3 class="text-center text-gray-600 mb-2">Barang Keluar Bulan Ini</h3>
                <div class="aspect-square w-[500px]">
                    <canvas id="barangKeluarPieChart" class="w-full h-full"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Trend Barang --}}
    <div class="bg-white p-4 rounded shadow mt-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-2">
            <h2 class="text-lg font-semibold">Trend Barang Masuk & Keluar</h2>
            <div class="flex items-center gap-2">
                <label for="filterTahun" class="text-gray-600">Tahun:</label>
                <select id="filterTahun" class="border border-gray-300 rounded px-3 py-2 shadow-sm">
                    @foreach ($availableYears as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="h-[400px]">
            <canvas id="barangLineChart" class="w-full h-full"></canvas>
        </div>
    </div>

    {{-- Status Stok --}}
    <div class="bg-white p-4 rounded shadow mt-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-2">
            <h2 class="text-lg font-semibold">Status Stok Barang</h2>
            <div class="flex items-center gap-2">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                        </svg>
                    </span>
                    <input type="text" id="searchInput" placeholder="Cari Barang..."
                        class="pl-10 pr-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none w-48">
                </div>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707l-7 7V20l-4-2v-6.293l-7-7A1 1 0 013 4z" />
                        </svg>
                    </span>
                    <select id="filterStatus" class="pl-10 pr-3 py-2 border border-gray-300 shadow-sm w-48">
                        <option value="semua">Semua Status</option>
                        <option value="aman">Aman</option>
                        <option value="menipis">Menipis</option>
                        <option value="kritis">Kritis</option>
                    </select>
                </div>
            </div>
        </div>
        {{-- (Tabel atau konten lainnya bisa ditambahkan di sini) --}}
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const datasetByYear = @json($datasetByYear);
        const pieMasukLabels = @json($pieMasukData['labels']);
        const pieMasukData = @json($pieMasukData['data']);
        const pieKeluarLabels = @json($pieKeluarData['labels']);
        const pieKeluarData = @json($pieKeluarData['data']);

        const filterTahun = document.getElementById('filterTahun');
        const ctxLine = document.getElementById('barangLineChart').getContext('2d');
        let chartLine;

        function renderLineChart(tahun) {
            const data = datasetByYear[tahun];
            if (!data) return;

            if (chartLine) chartLine.destroy();

            const gradientMasuk = ctxLine.createLinearGradient(0, 0, 0, 400);
            gradientMasuk.addColorStop(0, 'rgba(59, 130, 246, 0.3)');
            gradientMasuk.addColorStop(1, 'rgba(59, 130, 246, 0)');

            const gradientKeluar = ctxLine.createLinearGradient(0, 0, 0, 400);
            gradientKeluar.addColorStop(0, 'rgba(249, 115, 22, 0.3)');
            gradientKeluar.addColorStop(1, 'rgba(249, 115, 22, 0)');

            chartLine = new Chart(ctxLine, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                            label: 'Barang Masuk',
                            data: data.masuk,
                            borderColor: '#3b82f6',
                            backgroundColor: gradientMasuk,
                            tension: 0.4,
                            fill: true
                        },
                        {
                            label: 'Barang Keluar',
                            data: data.keluar,
                            borderColor: '#f97316',
                            backgroundColor: gradientKeluar,
                            tension: 0.4,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 10
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }

        // Pie Chart Masuk
        const ctxMasuk = document.getElementById('barangMasukPieChart').getContext('2d');
        new Chart(ctxMasuk, {
            type: 'doughnut',
            data: {
                labels: pieMasukLabels,
                datasets: [{
                    data: pieMasukData,
                    backgroundColor: [
                        '#21579a', '#2563ad', '#2c6fc0', '#337bd3', '#3b88e6',
                        '#4c94ea', '#5ca0ed', '#6dacef', '#7eb8f2', '#8ec4f5',
                        '#9fd0f7', '#afdcfa', '#bfe8fc', '#cff4ff', '#dcf6ff',
                        '#e6f7ff', '#eef9ff', '#f3fbff', '#f8fdff', '#fcfeff'
                    ].slice(0, pieMasukData.length)
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            boxWidth: 12,
                            padding: 16
                        }
                    }
                }
            }
        });

        // Pie Chart Keluar
        const ctxKeluar = document.getElementById('barangKeluarPieChart').getContext('2d');
        new Chart(ctxKeluar, {
            type: 'doughnut',
            data: {
                labels: pieKeluarLabels,
                datasets: [{
                    data: pieKeluarData,
                    backgroundColor: [
                        '#fb7c1d', '#fb923c', '#fca661', '#fcb076', '#fcbf85',
                        '#fdba74', '#fdbc83', '#fdd5a5', '#fed7aa', '#fee0b8',
                        '#fee5c1', '#feebcd', '#fef0d6', '#fff4df', '#fff7e5',
                        '#fff9eb', '#fffaf0', '#fffdf5', '#fffef9', '#ffffff'
                    ].slice(0, pieKeluarData.length)
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            boxWidth: 12,
                            padding: 16
                        }
                    }
                }
            }
        });

        // Init Chart
        renderLineChart(filterTahun.value);
        filterTahun.addEventListener('change', () => renderLineChart(filterTahun.value));
    </script>
@endsection
