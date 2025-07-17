<div class="flex justify-between items-center w-full">
    <!-- Judul Aplikasi -->
    <h1 class="text-xl font-semibold text-white tracking-tight">
        Aplikasi Manajemen Barang
    </h1>

    <!-- Logout Button -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
       <button
    class="bg-purple-500 hover:bg-purple-600 text-white text-sm font-medium px-4 py-1.5 rounded-lg shadow transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-400"
>
    Logout
</button>

    </form>
</div>
