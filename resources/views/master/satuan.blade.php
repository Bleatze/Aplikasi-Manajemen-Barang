@extends('layouts.main')

@section('title', 'Data Satuan')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Data Satuan</h1>

    {{-- Search + Tambah --}}
    <div class="p-4 rounded mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <form method="GET" action="{{ route('satuan.index') }}" id="filter-form" class="flex items-center gap-4 flex-wrap">
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                    </svg>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Satuan..."
                    class="bg-white pl-10 pr-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none w-64">
            </div>
        </form>
        <button onclick="openModal()" type="button"
            class="flex items-center gap-2 bg-primary text-white px-4 py-2 rounded hover:bg-kk transition">
            <img src="https://api.iconify.design/mdi:plus.svg?color=white" alt="Add Icon" />Tambah Satuan
        </button>
    </div>

    {{-- Modal Tambah Satuan --}}
    <div id="modal-tambah-satuan" onclick="handleBackdropClick(event)"
        class="fixed inset-0 bg-transparent backdrop-blur-sm hidden justify-center items-center z-50">
        <div class="bg-white rounded-lg w-full max-w-lg p-6 shadow-lg relative">
            <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 hover:text-red-500">
                <img src="https://api.iconify.design/mdi/close.svg?color=gray" class="w-5 h-5" />
            </button>
            <h2 class="text-xl font-semibold mb-4">Tambah Satuan</h2>
            <form action="{{ route('satuan.add') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium">Nama Satuan</label>
                    <input type="text" name="unit_name" required
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none">
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeModal()"
                        class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
                    <button type="submit" class="bg-primary text-white px-4 py-2 rounded hover:bg-kk">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-300 text-gray-700">
                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Nama Satuan</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($units as $satuan)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $satuan->unit_name }}</td>
                        <td class="px-4 py-2 text-center space-x-2">
                            <button onclick="openEditModal({{ $satuan->id }})"
                                class="bg-yellow-400 px-2 py-1 text-white rounded hover:bg-yellow-500">Edit</button>
                            <button onclick="openDeleteModal({{ $satuan->id }})"
                                class="bg-red-500 px-2 py-1 text-white rounded hover:bg-red-600">Hapus</button>
                        </td>
                    </tr>

                    {{-- Modal Edit --}}
                    <div id="modal-edit-satuan-{{ $satuan->id }}" onclick="handleBackdropClickEdit(event)"
                        class="fixed inset-0 bg-transparent backdrop-blur-sm hidden justify-center items-center z-50">
                        <div class="bg-white rounded-lg w-full max-w-lg p-6 shadow-lg relative">
                            <button onclick="closeEditModal({{ $satuan->id }})"
                                class="absolute top-3 right-3 text-gray-500 hover:text-red-500">
                                <img src="https://api.iconify.design/mdi/close.svg?color=gray" class="w-5 h-5" />
                            </button>
                            <h2 class="text-xl font-semibold mb-4">Edit Satuan</h2>
                            <form action="{{ route('satuan.update', $satuan->id) }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PUT')
                                <div>
                                    <label class="block text-sm font-medium">Nama Satuan</label>
                                    <input type="text" name="unit_name" value="{{ $satuan->name }}" required
                                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none">
                                </div>
                                <div class="flex justify-end gap-2">
                                    <button type="button" onclick="closeEditModal({{ $satuan->id }})"
                                        class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
                                    <button type="submit"
                                        class="bg-primary text-white px-4 py-2 rounded hover:bg-kk">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-2 text-center text-gray-500">Tidak ada data satuan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Modal Hapus --}}
    <div id="modal-confirm-delete" onclick="handleBackdropClickDelete(event)"
        class="fixed inset-0 bg-transparent backdrop-blur-sm hidden justify-center items-center z-50">
        <div class="bg-white rounded-lg w-full max-w-md p-6 shadow-lg relative">
            <button onclick="closeDeleteModal()" class="absolute top-3 right-3 text-gray-500 hover:text-red-500">
                <img src="https://api.iconify.design/mdi/close.svg?color=gray" class="w-5 h-5" />
            </button>
            <h2 class="text-xl font-semibold mb-4">Konfirmasi Hapus</h2>
            <p class="mb-6">Apakah Anda yakin ingin menghapus satuan ini? Tindakan ini tidak dapat dibatalkan.</p>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeDeleteModal()"
                    class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
                <form id="form-delete-satuan" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Hapus</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('input[name="search"]');
            const form = document.getElementById('filter-form');
            let typingTimer;
            if (searchInput) {
                searchInput.focus();
                const val = searchInput.value;
                searchInput.value = '';
                searchInput.value = val;
            }
            searchInput.addEventListener('keyup', function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(() => {
                    form.submit();
                }, 500);
            });
        });

        function openModal() {
            document.getElementById('modal-tambah-satuan').classList.remove('hidden');
            document.getElementById('modal-tambah-satuan').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('modal-tambah-satuan').classList.add('hidden');
            document.getElementById('modal-tambah-satuan').classList.remove('flex');
        }

        function handleBackdropClick(event) {
            if (event.target === event.currentTarget) {
                closeModal();
            }
        }

        function openEditModal(id) {
            document.getElementById('modal-edit-satuan-' + id).classList.remove('hidden');
            document.getElementById('modal-edit-satuan-' + id).classList.add('flex');
        }

        function closeEditModal(id) {
            document.getElementById('modal-edit-satuan-' + id).classList.add('hidden');
            document.getElementById('modal-edit-satuan-' + id).classList.remove('flex');
        }

        function handleBackdropClickEdit(event) {
            if (event.target === event.currentTarget) {
                document.querySelectorAll('[id^="modal-edit-satuan-"]').forEach(modal => {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                });
            }
        }

        let deleteSatuanId = null;

        function openDeleteModal(id) {
            deleteSatuanId = id;
            const form = document.getElementById('form-delete-satuan');
            form.action = '/satuan/' + id;
            document.getElementById('modal-confirm-delete').classList.remove('hidden');
            document.getElementById('modal-confirm-delete').classList.add('flex');
        }

        function closeDeleteModal() {
            document.getElementById('modal-confirm-delete').classList.add('hidden');
            document.getElementById('modal-confirm-delete').classList.remove('flex');
            deleteSatuanId = null;
        }

        function handleBackdropClickDelete(event) {
            if (event.target === event.currentTarget) {
                closeDeleteModal();
            }
        }
    </script>
@endsection
