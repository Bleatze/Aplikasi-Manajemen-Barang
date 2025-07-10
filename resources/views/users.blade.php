@extends('layouts.main')

@section('title', 'Manajemen User')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Manajemen User</h1>

{{-- Search + Filter + Tambah User --}}
<div class="p-4 rounded mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div class="flex items-center gap-4 flex-wrap">
        <form method="GET" action="{{ route('users.index') }}" id="filter-form"
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
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari user..."
                    class="bg-white pl-10 pr-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none w-64">
            </div>

            <!-- Select role -->
            <div class="relative inline-block">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <img src="https://api.iconify.design/mdi/filter-variant.svg?color=gray" alt="Filter"
                        class="w-4 h-4">
                </span>
                <select name="role"
                    class="bg-white border border-gray-300 shadow rounded py-2 pl-9 pr-3 text-sm text-gray-600 focus:outline-none">
                    <option value="">Semua Peran</option>
                    <option value="admin" {{ request('role')=='admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ request('role')=='user' ? 'selected' : '' }}>User</option>
                </select>
            </div>
        </form>
    </div>

    <!-- Tombol buka modal tambah -->
    <button onclick="openModal()"
        class="flex items-center gap-2 bg-primary text-white px-4 py-2 rounded hover:bg-kk transition">
        <img src="https://api.iconify.design/mdi/account-plus.svg?color=white" alt="Add User" class="w-5 h-5">
        Tambah User
    </button>
</div>

<!-- Modal tambah user -->
<div id="modal-tambah-user" onclick="handleBackdropClick(event)"
    class="fixed inset-0 bg-transparent backdrop-blur-sm hidden justify-center items-center z-50">
    <div class="bg-white rounded-lg w-full max-w-lg p-6 shadow-lg relative">
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
        <h2 class="text-xl font-semibold mb-4">Tambah User</h2>
        <form action="{{ route('users.add') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium">Nama</label>
                <input type="text" name="name" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium">Peran</label>
                <select name="role" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none">
                    <option value="admin">admin</option>
                    <option value="user">user</option>
                </select>
            </div>
            <div>
                <label class="block mb-1">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="password" required
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none">

                    <button type="button" onclick="togglePassword()"
                        class="absolute right-2 top-2 text-gray-500 hover:text-blue-600 transition-colors">
                        <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z" />
                            <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.5" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 5l1.5 2M8 4l1 2M12 3v2M16 4l-1 2M20 5l-1.5 2" />
                        </svg>

                        <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 block" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M2 12s4-5 10-5 10 5 10 5-4 5-10 5S2 12 2 12z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 9c2-2 6-3 8-3s6 1 8 3" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal()"
                    class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
                <button type="submit" class="bg-primary text-white px-4 py-2 rounded hover:bg-kk">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Tabel daftar user --}}
<div class="bg-white rounded shadow overflow-x-auto">
    <table class="min-w-full text-sm text-left">
        <thead class="bg-gray-300 text-gray-700">
            <tr>
                <th class="px-4 py-3">No</th>
                <th class="px-4 py-3">Nama</th>
                <th class="px-4 py-3">Email</th>
                <th class="px-4 py-3">Peran</th>
                <th class="px-4 py-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                <td class="px-4 py-3">{{ $user->name }}</td>
                <td class="px-4 py-3">{{ $user->email }}</td>
                <td class="px-4 py-3">{{ $user->role }}</td>
                <td class="px-4 py-3 text-center space-x-2">
                    <button onclick="openEditModal({{ $user->id }})"
                        class="inline-flex items-center px-3 py-1 text-sm text-white bg-yellow-500 rounded hover:bg-yellow-600">
                        <img src="https://api.iconify.design/mdi/pencil.svg?color=white" class="w-4 h-4 mr-1"
                            alt="Edit"> Edit
                    </button>
                    <button onclick="openDeleteModal({{ $user->id }})"
                        class="inline-flex items-center px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600">
                        <img src="https://api.iconify.design/mdi/trash-can.svg?color=white" class="w-4 h-4 mr-1"
                            alt="Delete"> Hapus
                    </button>
                </td>
            </tr>

            <!-- Modal edit user (satu per user) -->
            <div id="modal-edit-user-{{ $user->id }}" onclick="handleBackdropClickEdit(event)"
                class="fixed inset-0 bg-transparent backdrop-blur-sm hidden justify-center items-center z-50">
                <div class="bg-white rounded-lg w-full max-w-lg p-6 shadow-lg relative">
                    <button onclick="closeEditModal({{ $user->id }})"
                        class="absolute top-3 right-3 text-gray-500 hover:text-red-500">
                        <img src="https://api.iconify.design/mdi/close.svg?color=gray" class="w-5 h-5" />
                    </button>
                    @if ($errors->getBag('edit_' . $user->id)->any())
                    <div class="alert bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded m-4 animate-fade">
                        <div class="flex items-start justify-between">
                            <div>
                                <strong class="font-bold">Oops!</strong>
                                <ul class="mt-1 list-disc list-inside text-sm">
                                    @foreach ($errors->getBag('edit_' . $user->id)->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <button type="button" onclick="closeAlert(this)" class="font-bold px-2">×</button>
                        </div>
                    </div>
                    @endif
                    <h2 class="text-xl font-semibold mb-4">Edit User</h2>
                    <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block text-sm font-medium">Nama</label>
                            <input type="text" name="name" value="{{ $user->name }}" required
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Email</label>
                            <input type="email" name="email" value="{{ $user->email }}" required
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Peran</label>
                            <select name="role"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none">
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>admin
                                </option>
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>user</option>
                            </select>
                        </div>
                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" id="change-password-checkbox-{{ $user->id }}"
                                    onchange="togglePasswordInput({{ $user->id }})" class="form-checkbox text-primary">
                                <span class="ml-2">Ganti Password</span>
                            </label>
                        </div>
                        <div id="password-input-{{ $user->id }}" class="hidden">
                            <label class="block text-sm font-medium">Password Baru</label>
                            <div class="relative">
                                <input type="password" name="passwordEdit" id="password" required
                                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none">

                                <button type="button" onclick="togglePasswordEdit({{ $user->id }})"
                                    class="absolute right-2 top-2 text-gray-500 hover:text-blue-600 transition-colors">
                                    <svg id="eyeOpen-{{ $user->id  }}" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z" />
                                        <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.5" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 5l1.5 2M8 4l1 2M12 3v2M16 4l-1 2M20 5l-1.5 2" />
                                    </svg>

                                    <svg id="eyeClosed-{{ $user->id  }}" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 block"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M2 12s4-5 10-5 10 5 10 5-4 5-10 5S2 12 2 12z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 9c2-2 6-3 8-3s6 1 8 3" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="flex justify-end gap-2 mt-2">
                            <button type="button" onclick="closeEditModal({{ $user->id }})"
                                class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
                            <button type="submit"
                                class="bg-primary text-white px-4 py-2 rounded hover:bg-kk">Simpan</button>
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
        <p class="mb-6">Apakah Anda yakin ingin menghapus user ini? Tindakan ini tidak dapat dibatalkan.</p>
        <div class="flex justify-end gap-2">
            <button type="button" onclick="closeDeleteModal()"
                class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
            <form id="form-delete-user" method="POST">
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
            const roleSelect = document.querySelector('select[name="role"]');
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

            roleSelect.addEventListener('change', function() {
                form.submit();
            });

        });

        function openModal() {
            document.getElementById('modal-tambah-user').classList.remove('hidden');
            document.getElementById('modal-tambah-user').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('modal-tambah-user').classList.add('hidden');
            document.getElementById('modal-tambah-user').classList.remove('flex');
            resetModal();
        }

        function resetModal() {
            const modal = document.getElementById('modal-tambah-user');
            modal.querySelectorAll('input').forEach(input => {
                if (input.type === 'checkbox' || input.type === 'radio') {
                    input.checked = false;
                } else if (input.name !== '_token') { // jangan reset CSRF token
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

        function handleBackdropClick(event) {
            if (event.target === event.currentTarget) {
                closeModal();
            }
        }

        function openEditModal(id) {
            document.getElementById('modal-edit-user-' + id).classList.remove('hidden');
            document.getElementById('modal-edit-user-' + id).classList.add('flex');
        }

        function closeEditModal(id) {
            document.getElementById('modal-edit-user-' + id).classList.add('hidden');
            document.getElementById('modal-edit-user-' + id).classList.remove('flex');
            resetEditModal(id);
        }

        function resetEditModal(id) {
            const modal = document.getElementById('modal-edit-user-' + id);
            modal.querySelectorAll('input').forEach(input => {
                if (input.type === 'checkbox' || input.type === 'radio') {
                    input.checked = false;
                } else if (input.name !== '_token' && input.name !== '_method') {
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
                document.querySelectorAll('[id^="modal-edit-user-"]').forEach(modal => {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                });
            }
        }

        let deleteUserId = null;

        function openDeleteModal(id) {
            deleteUserId = id;
            const form = document.getElementById('form-delete-user');
            form.action = '/users/' + id;
            document.getElementById('modal-confirm-delete').classList.remove('hidden');
            document.getElementById('modal-confirm-delete').classList.add('flex');
        }

        function closeDeleteModal() {
            document.getElementById('modal-confirm-delete').classList.add('hidden');
            document.getElementById('modal-confirm-delete').classList.remove('flex');
            deleteUserId = null;
        }

        function handleBackdropClickDelete(event) {
            if (event.target === event.currentTarget) {
                closeDeleteModal();
            }
        }

        function togglePasswordInput(id) {
            const checkbox = document.getElementById('change-password-checkbox-' + id);
            const passwordInput = document.getElementById('password-input-' + id);
            if (checkbox.checked) {
                passwordInput.classList.remove('hidden');
            } else {
                passwordInput.classList.add('hidden');
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            @if ($errors->any())
                openModal();
            @endif
            @foreach ($users as $user)
                @if ($errors->getBag('edit_' . $user->id)->any())
                    openEditModal({{ $user->id }});
                @endif
            @endforeach
        });
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const eyeOpen = document.getElementById("eyeOpen");
            const eyeClosed = document.getElementById("eyeClosed");

            const isHidden = passwordInput.type === "password";
            passwordInput.type = isHidden ? "text" : "password";
            eyeOpen.classList.toggle("hidden", !isHidden);
            eyeClosed.classList.toggle("hidden", isHidden);
        }
        function togglePasswordEdit(id) {
            const wrapper = document.getElementById('password-input-' + id);
            const passwordInput = wrapper.querySelector('input[name="passwordEdit"]');
            const eyeOpen = document.getElementById('eyeOpen-' + id);
            const eyeClosed = document.getElementById('eyeClosed-' + id);

            const isHidden = passwordInput.type === "password";
            passwordInput.type = isHidden ? "text" : "password";
            eyeOpen.classList.toggle("hidden", !isHidden);
            eyeClosed.classList.toggle("hidden", isHidden);
        }
</script>
@endsection