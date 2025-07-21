@extends('layouts.main')

@section('title', 'Data Barang')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Data Barang</h1>

    <div class="p-4 rounded mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <form method="GET" action="{{ route('barang.index') }}" id="filter-form" class="flex gap-4 flex-wrap">
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                    </svg>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Barang..."
                    class="bg-white pl-10 pr-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none w-64">
            </div>

            <div class="relative inline-block">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <img src="https://api.iconify.design/mdi/filter-variant.svg?color=gray" alt="Filter" class="w-4 h-4">
                </span>
                <select name="category_id" onchange="this.form.submit()"
                    class="bg-white border border-gray-300 shadow rounded py-2 pl-9 pr-3 text-sm text-gray-600 focus:outline-none">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        <button onclick="openModal()" type="submit"
            class="flex items-center gap-2 bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded transition">
            <img src="https://api.iconify.design/mdi:plus.svg?color=white" alt="Add Icon" />Tambah
        </button>
        <div id="modal-tambah-barang" onclick="handleBackdropClick(event)"
            class="fixed inset-0 bg-transparent backdrop-blur-sm hidden justify-center items-center z-50">
            <!-- Modal box -->
            <div class="bg-white rounded-lg w-full max-w-lg p-6 shadow-lg relative">
                <!-- Tombol close -->
                <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 hover:text-red-500">
                    <img src="https://api.iconify.design/mdi/close.svg?color=gray" class="w-5 h-5" />
                </button>
                @if ($errors->any())
                    <div class="alert bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded m-4 animate-fade">
                        <div class="flex items-start justify-between">
                            <div>
                                <strong class="font-bold">Oops!</strong>
                                <ul class="mt-1 list-disc list-inside text-sm">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <button type="button" onclick="closeAlert(this)" class="font-bold px-2">×</button>
                        </div>
                    </div>
                @endif
                <h2 class="text-xl font-semibold mb-4">Tambah Barang</h2>

                <form action="{{ route('barang.add') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium">Nama Barang</label>
                        <input type="text" name="name" id="name" required
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-primary">
                    </div>
                    <div>
                        <label for="category" class="block text-sm font-medium">Kategori</label>
                        <select name="category" required
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-primary">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="unit" class="block text-sm font-medium">Satuan</label>
                        <select name="unit" required
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-primary">
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="min_stock" class="block text-sm font-medium">Minimal Stok</label>
                        <input type="number" name="min_stock" id="min_stock" required min="0"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-primary">
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeModal()"
                            class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
                        <button type="submit"
                            class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded transition">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-300 text-gray-700">
                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Kategori</th>
                    <th class="px-4 py-3">Satuan</th>
                    <th class="px-4 py-3">Stok Minimum</th>
                    <th class="px-4 py-3">Stok</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($wares as $index => $ware)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">{{ $ware->ware_name }}</td>
                        <td class="px-4 py-2">{{ $ware->category->category_name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $ware->unit->unit_name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $ware->min_stock }}</td>
                        <td class="px-4 py-2">{{ $ware->stock }}</td>
                        <td class="px-4 py-2 text-center space-x-2">
                            <button onclick="openEditModal({{ $ware->id }})"
                                class="inline-flex items-center px-3 py-1 text-sm text-white bg-yellow-500 rounded hover:bg-yellow-600">
                                <img src="https://api.iconify.design/mdi/pencil.svg?color=white" class="w-4 h-4 mr-1"
                                    alt="Edit"> Edit
                            </button>
                            <button onclick="openDeleteModal({{ $ware->id }})"
                                class="inline-flex items-center px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600">
                                <img src="https://api.iconify.design/mdi/trash-can.svg?color=white" class="w-4 h-4 mr-1"
                                    alt="Delete"> Hapus
                            </button>
                        </td>
                    </tr>

                    <div id="modal-edit-barang-{{ $ware->id }}" onclick="handleBackdropClickEdit(event)"
                        class="fixed inset-0 bg-transparent backdrop-blur-sm hidden justify-center items-center z-50">
                        <div class="bg-white rounded-lg w-full max-w-lg p-6 shadow-lg relative">
                            <button onclick="closeEditModal({{ $ware->id }})"
                                class="absolute top-3 right-3 text-gray-500 hover:text-red-500">
                                <img src="https://api.iconify.design/mdi/close.svg?color=gray" class="w-5 h-5" />
                            </button>

                            @if ($errors->getBag('edit_' . $ware->id)->any())
                                <div
                                    class="alert bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded m-4 animate-fade">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <strong class="font-bold">Oops!</strong>
                                            <ul class="mt-1 list-disc list-inside text-sm">
                                                @foreach ($errors->getBag('edit_' . $ware->id)->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <button type="button" onclick="closeAlert(this)"
                                            class="font-bold px-2">×</button>
                                    </div>
                                </div>
                            @endif

                            <h2 class="text-xl font-semibold mb-4">Edit Barang</h2>
                            <form action="{{ route('barang.update', $ware->id) }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PUT')

                                <div>
                                    <label class="block text-sm font-medium">Nama Barang</label>
                                    <input type="text" name="ware_name" value="{{ $ware->ware_name }}" required
                                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium">Kategori</label>
                                    <select name="category_id"
                                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $ware->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium">Satuan</label>
                                    <select name="unit_id"
                                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none">
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->id }}"
                                                {{ $ware->unit_id == $unit->id ? 'selected' : '' }}>
                                                {{ $unit->unit_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium">Stok Minimum</label>
                                    <input type="number" name="min_stock" value="{{ $ware->min_stock }}"
                                        min="0" required
                                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none">
                                </div>

                                <div class="flex justify-end gap-2 mt-2">
                                    <button type="button" onclick="closeEditModal({{ $ware->id }})"
                                        class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
                                    <button type="submit"
                                        class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded ">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
    <div id="modal-confirm-delete" onclick="handleBackdropClickDelete(event)"
        class="fixed inset-0 bg-transparent backdrop-blur-sm hidden justify-center items-center z-50">
        <div class="bg-white rounded-lg w-full max-w-md p-6 shadow-lg relative">
            <button onclick="closeDeleteModal()" class="absolute top-3 right-3 text-gray-500 hover:text-red-500">
                <img src="https://api.iconify.design/mdi/close.svg?color=gray" class="w-5 h-5" />
            </button>
            <h2 class="text-xl font-semibold mb-4">Konfirmasi Hapus</h2>
            <p class="mb-6">Apakah Anda yakin ingin menghapus barang ini? Tindakan ini tidak dapat dibatalkan.</p>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeDeleteModal()"
                    class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
                <form id="form-delete-ware" method="POST">
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
            document.getElementById('modal-tambah-barang').classList.remove('hidden');
            document.getElementById('modal-tambah-barang').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('modal-tambah-barang').classList.add('hidden');
            document.getElementById('modal-tambah-barang').classList.remove('flex');
            resetModal();
        }

        function handleBackdropClick(event) {
            if (event.target === event.currentTarget) {
                closeModal();
            }
        }

        function resetModal() {
            const modal = document.getElementById('modal-tambah-barang');
            modal.querySelectorAll('input').forEach(input => {
                if (input.name !== '_token') { // jangan reset CSRF token
                    input.value = '';
                }
            });
            modal.querySelectorAll('select').forEach(select => {
                select.selectedIndex = 0;
            });
            modal.querySelectorAll('.alert').forEach(alert => {
                alert.remove();
            });
        }
        document.addEventListener('DOMContentLoaded', function() {
            @if ($errors->any())
                openModal();
            @endif
            @foreach ($wares as $ware)
                @if ($errors->getBag('edit_' . $ware->id)->any())
                    openEditModal({{ $ware->id }});
                @endif
            @endforeach
        });

        function openEditModal(id) {
            document.getElementById('modal-edit-barang-' + id).classList.remove('hidden');
            document.getElementById('modal-edit-barang-' + id).classList.add('flex');
        }

        function closeEditModal(id) {
            document.getElementById('modal-edit-barang-' + id).classList.add('hidden');
            document.getElementById('modal-edit-barang-' + id).classList.remove('flex');
            resetEditModal(id);
        }

        function resetEditModal(id) {
            const modal = document.getElementById('modal-edit-barang-' + id);
            modal.querySelectorAll('input').forEach(input => {
                if (input.name !== '_token' && input.name !== '_method') {
                    input.value = '';
                }
            });
            modal.querySelectorAll('select').forEach(select => {
                select.selectedIndex = 0;
            });
            modal.querySelectorAll('.alert').forEach(alert => {
                alert.remove();
            });
        }


        function handleBackdropClickEdit(event) {
            if (event.target === event.currentTarget) {
                document.querySelectorAll('[id^="modal-edit-barang-"]').forEach(modal => {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                });
            }
        }

        let deletewareId = null;

        function openDeleteModal(id) {
            deletewareId = id;
            const form = document.getElementById('form-delete-ware');
            form.action = '/barang/' + id;
            document.getElementById('modal-confirm-delete').classList.remove('hidden');
            document.getElementById('modal-confirm-delete').classList.add('flex');
        }

        function closeDeleteModal() {
            document.getElementById('modal-confirm-delete').classList.add('hidden');
            document.getElementById('modal-confirm-delete').classList.remove('flex');
            deletewareId = null;
        }

        function handleBackdropClickDelete(event) {
            if (event.target === event.currentTarget) {
                closeDeleteModal();
            }
        }
    </script>
@endsection
