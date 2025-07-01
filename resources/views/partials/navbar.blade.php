<header class="bg-soft text-primary shadow px-6 py-4">
    <div class="flex justify-between items-center">
        <h1 class="text-xl font-bold">Aplikasi Barang</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="bg-primary text-white px-4 py-1 rounded hover:bg-soft-dark text-sm">Logout</button>
        </form>
    </div>
</header>
