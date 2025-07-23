@extends('layouts.main')

@section('title', 'Laporan')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Laporan Barang</h1>

    @php
        use Carbon\Carbon;

        $startDate = request('start_date');
        $endDate = request('end_date');
        $today = Carbon::today()->toDateString();
    @endphp

    <div class="p-4 mb-6">
        <form class="grid md:grid-cols-3 gap-4" method="GET" action="{{ route('laporan.index') }}">
            <div>
                <label class="block text-sm mb-1">Tanggal Mulai</label>
                <input type="text" name="start_date"
                       class="flatpickr w-full border rounded px-3 py-2"
                       value="{{ $startDate }}" placeholder="Pilih tanggal mulai"
                       data-max="{{ $endDate ?? $today }}">
            </div>
            <div>
                <label class="block text-sm mb-1">Tanggal Selesai</label>
                <input type="text" name="end_date"
                       class="flatpickr w-full border rounded px-3 py-2"
                       value="{{ $endDate }}" placeholder="Pilih tanggal selesai"
                       data-min="{{ $startDate }}" data-max="{{ $today }}">
            </div>
            <button type="submit"
                    class="bg-purple-500 hover:bg-purple-600 text-white mt-6 py-2 rounded col-span-full md:col-span-1">
                Tampilkan
            </button>
        </form>
    </div>

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
                @forelse ($laporan as $item)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $item['tanggal']->toDateString() }}</td>
                        <td class="px-4 py-2">{{ $item['jenis'] }}</td>
                        <td class="px-4 py-2">{{ $item['barang'] }}</td>
                        <td class="px-4 py-2">{{ $item['jumlah'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center px-4 py-2">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const startInput = document.querySelector("input[name='start_date']");
            const endInput = document.querySelector("input[name='end_date']");
            const today = new Date().toISOString().split('T')[0];

            const startPicker = flatpickr(startInput, {
                dateFormat: "Y-m-d",
                maxDate: endInput.value || today,
                onChange: function (selectedDates, dateStr) {
                    endPicker.set("minDate", dateStr);
                },
            });

            const endPicker = flatpickr(endInput, {
                dateFormat: "Y-m-d",
                minDate: startInput.value,
                maxDate: today,
                onChange: function (selectedDates, dateStr) {
                    startPicker.set("maxDate", dateStr);
                },
            });
        });
    </script>
@endpush

