@extends('layouts.main')

@section('title', 'Manajemen User')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Manajemen User</h1>

{{-- Search + Filter + Tambah User --}}
<div class=" p-4 rounded mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div class="flex items-center gap-4 flex-wrap">
        <!-- Search Input -->
        <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
            </span>
            <input type="text" placeholder="Cari user..."
                   class="bg-white pl-10 pr-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none w-64">
        </div>

       <div class="relative inline-block">
             <!-- Ikon filter -->
             <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                 <img src="https://api.iconify.design/mdi/filter-variant.svg?color=gray" alt="Filter"
                      class="w-4 h-4">
             </span>
         
                 <!-- Select dengan padding kiri agar tidak menabrak ikon -->
             <select class="bg-white border border-gray-300 shadow rounded py-2 pl-9 pr-3 text-sm text-gray-600 focus:outline-none">
                 <option value="">Semua Peran</option>
                 <option value="admin">Admin</option>
                 <option value="user">User</option>
             </select>
         </div>
</div>

    <!-- Tombol buka modal -->
<button onclick="openModal()" class="flex items-center gap-2 bg-primary text-white px-4 py-2 rounded hover:bg-kk transition">
    <img src="https://api.iconify.design/mdi/account-plus.svg?color=white" alt="Add User" class="w-5 h-5">
    Tambah User
</button>


<!-- Modal backdrop -->
<div id="modal-tambah-user" onclick="handleBackdropClick(event)" class="fixed inset-0 bg-transparent backdrop-blur-sm hidden justify-center items-center z-50">
    <!-- Modal box -->
    <div class="bg-white rounded-lg w-full max-w-lg p-6 shadow-lg relative">
        <!-- Tombol close -->
        <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 hover:text-red-500">
            <img src="https://api.iconify.design/mdi/close.svg?color=gray" class="w-5 h-5" />
        </button>

        <h2 class="text-xl font-semibold mb-4">Tambah User</h2>

        <form action="" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium">Nama</label>
                <input type="text" name="name" id="name" required
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-primary">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium">Email</label>
                <input type="email" name="email" id="email" required
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-primary">
            </div>

            <div>
                <label for="role" class="block text-sm font-medium">Peran</label>
                <select name="role" id="role"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-primary">
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium">Password</label>
                <input type="password" name="password" id="password" required
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-primary">
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal()" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
                <button type="submit" class="bg-primary text-white px-4 py-2 rounded hover:bg-kk transition">Simpan</button>
            </div>
        </form>
    </div>
</div>


    </div>

{{-- Tabel Daftar User --}}
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
            @for ($i = 1; $i <= 5; $i++)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-3">{{ $i }}</td>
                <td class="px-4 py-3">User {{ $i }}</td>
                <td class="px-4 py-3">user{{ $i }}@example.com</td>
                <td class="px-4 py-3">{{ $i % 2 == 0 ? 'Admin' : 'User' }}</td>
                <td class="px-4 py-3 text-center space-x-2">
                    <!-- Tombol Edit -->
                    <a href="#" class="inline-flex items-center px-3 py-1 text-sm text-white bg-yellow-500 rounded hover:bg-yellow-600">
                        <img src="https://api.iconify.design/mdi/pencil.svg?color=white" class="w-4 h-4 mr-1" alt="Edit">
                        Edit
                    </a>

                    <!-- Tombol Hapus -->
                    <button onclick="confirm('Yakin ingin menghapus user ini?')"
                            class="inline-flex items-center px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600">
                        <img src="https://api.iconify.design/mdi/trash-can.svg?color=white" class="w-4 h-4 mr-1" alt="Delete">
                        Hapus
                    </button>
                </td>
            </tr>
            @endfor
        </tbody>
    </table>
</div>
<script>
    function openModal() {
        document.getElementById('modal-tambah-user').classList.remove('hidden');
        document.getElementById('modal-tambah-user').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('modal-tambah-user').classList.add('hidden');
        document.getElementById('modal-tambah-user').classList.remove('flex');
    }
    function handleBackdropClick(event) {
       if(event.target===event.currentTarget){
         closeModal();
       }
    }
</script>
@endsection
