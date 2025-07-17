@extends('layouts.main')

@section('title', 'Data Kategori')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Data Kategori</h1>

{{-- Search + Tambah Kategori --}}
<div class="p-4 rounded mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <form method="GET" action="{{ route('kategori.index') }}" id="filter-form"
        class="flex items-center gap-4 flex-wrap">
        <!-- Input search -->
        <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
            </span>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kategori..."
                class="bg-white pl-10 pr-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none w-64">
        </div>
    </form>

    <!-- Tombol buka modal tambah -->
    <button onclick="openModal()"
        class="flex items-center gap-2  bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded transition">
        <img src="https://api.iconify.design/mdi/plus.svg?color=white" alt="Add Icon" class="w-5 h-5"> Tambah Kategori
    </button>
</div>

<!-- Modal tambah kategori -->
<div id="modal-tambah-kategori" onclick="handleBackdropClick(event)"
    class="fixed inset-0 bg-transparent backdrop-blur-sm hidden justify-center items-center z-50">
    <div class="bg-white rounded-lg w-full max-w-lg p-6 shadow-lg relative">
        <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 hover:text-red-500">
            <img src="https://api.iconify.design/mdi/close.svg?color=gray" class="w-5 h-5" />
        </button>
        @if ($errors->any())
        <div class="alert bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 animate-fade">
            <strong class="font-bold">Oops!</strong>
            <ul class="mt-1 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <h2 class="text-xl font-semibold mb-4">Tambah Kategori</h2>
        <form action="{{ route('kategori.add') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium">Nama Kategori</label>
                <input type="text" name="category_name" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none">
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal()"
                    class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
                <button type="submit" class=" bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Tabel daftar kategori --}}
<div class="bg-white rounded shadow overflow-x-auto">
    <table class="min-w-full text-sm text-left">
        <thead class="bg-gray-300 text-gray-700">
            <tr>
                <th class="px-4 py-3">No</th>
                <th class="px-4 py-3">Nama Kategori</th>
                <th class="px-4 py-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kategoris as $kategori)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                <td class="px-4 py-3">{{ $kategori->category_name }}</td>
                <td class="px-4 py-3 text-center space-x-2">
                    <button onclick="openEditModal({{ $kategori->id }})"
                        class="inline-flex items-center px-3 py-1 text-sm text-white bg-yellow-500 rounded hover:bg-yellow-600">
                        <img src="https://api.iconify.design/mdi/pencil.svg?color=white" class="w-4 h-4 mr-1"
                            alt="Edit"> Edit
                    </button>
                    <button onclick="openDeleteModal({{ $kategori->id }})"
                        class="inline-flex items-center px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600">
                        <img src="https://api.iconify.design/mdi/trash-can.svg?color=white" class="w-4 h-4 mr-1"
                            alt="Delete"> Hapus
                    </button>
                </td>
            </tr>

            <!-- Modal edit kategori -->
            <div id="modal-edit-kategori-{{ $kategori->id }}" onclick="handleBackdropClickEdit(event)"
                class="fixed inset-0 bg-transparent backdrop-blur-sm hidden justify-center items-center z-50">
                <div class="bg-white rounded-lg w-full max-w-lg p-6 shadow-lg relative">
                    <button onclick="closeEditModal({{ $kategori->id }})"
                        class="absolute top-3 right-3 text-gray-500 hover:text-red-500">
                        <img src="https://api.iconify.design/mdi/close.svg?color=gray" class="w-5 h-5" />
                    </button>
                    @if ($errors->getBag('edit_' . $kategori->id)->any())
                    <div
                        class="alert bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 animate-fade">
                        <ul class="mt-1 list-disc list-inside text-sm">
                            @foreach ($errors->getBag('edit_' . $kategori->id)->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <h2 class="text-xl font-semibold mb-4">Edit Kategori</h2>
                    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block text-sm font-medium">Nama Kategori</label>
                            <input type="text" name="category_name" value="{{ $kategori->category_name }}" required
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none">
                        </div>
                        <div class="flex justify-end gap-2 mt-2">
                            <button type="button" onclick="closeEditModal({{ $kategori->id }})"
                                class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
                            <button type="submit"
                                class=" bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal konfirmasi hapus -->
<div id="modal-confirm-delete" onclick="handleBackdropClickDelete(event)"
    class="fixed inset-0 bg-transparent backdrop-blur-sm hidden justify-center items-center z-50">
    <div class="bg-white rounded-lg w-full max-w-md p-6 shadow-lg relative">
        <button onclick="closeDeleteModal()" class="absolute top-3 right-3 text-gray-500 hover:text-red-500">
            <img src="https://api.iconify.design/mdi/close.svg?color=gray" class="w-5 h-5" />
        </button>
        <h2 class="text-xl font-semibold mb-4">Konfirmasi Hapus</h2>
        <p class="mb-6">Apakah Anda yakin ingin menghapus kategori ini? Tindakan ini tidak dapat dibatalkan.</p>
        <div class="flex justify-end gap-2">
            <button type="button" onclick="closeDeleteModal()"
                class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
            <form id="form-delete-kategori" method="POST">
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

            @if ($errors->any())
                openModal();
            @endif

            @foreach ($kategoris as $kategori)
                @if ($errors->getBag('edit_' . $kategori->id)->any())
                    openEditModal({{ $kategori->id }});
                @endif
            @endforeach
        });

        function openModal() {
            document.getElementById('modal-tambah-kategori').classList.remove('hidden');
            document.getElementById('modal-tambah-kategori').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('modal-tambah-kategori').classList.add('hidden');
            document.getElementById('modal-tambah-kategori').classList.remove('flex');
        }

        function handleBackdropClick(event) {
            if (event.target === event.currentTarget) {
                closeModal();
            }
        }

        function openEditModal(id) {
            document.getElementById('modal-edit-kategori-' + id).classList.remove('hidden');
            document.getElementById('modal-edit-kategori-' + id).classList.add('flex');
        }

        function closeEditModal(id) {
            document.getElementById('modal-edit-kategori-' + id).classList.add('hidden');
            document.getElementById('modal-edit-kategori-' + id).classList.remove('flex');
        }

        function handleBackdropClickEdit(event) {
            if (event.target === event.currentTarget) {
                document.querySelectorAll('[id^="modal-edit-kategori-"]').forEach(modal => {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                });
            }
        }

        let deleteKategoriId = null;

        function openDeleteModal(id) {
            deleteKategoriId = id;
            const form = document.getElementById('form-delete-kategori');
            form.action = '/kategori/' + id;
            document.getElementById('modal-confirm-delete').classList.remove('hidden');
            document.getElementById('modal-confirm-delete').classList.add('flex');
        }

        function closeDeleteModal() {
            document.getElementById('modal-confirm-delete').classList.add('hidden');
            document.getElementById('modal-confirm-delete').classList.remove('flex');
            deleteKategoriId = null;
        }

        function handleBackdropClickDelete(event) {
            if (event.target === event.currentTarget) {
                closeDeleteModal();
            }
        }
</script>
@endsection