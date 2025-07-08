<header class="bg-ob text-white shadow px-6 py-4">
    <div class="flex justify-between items-center">
        
        <h1 class="text-xl font-bold">Aplikasi Manajemen Barang</h1>

        <div class="flex items-center gap-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="bg-primary text-white px-4 py-1 rounded hover:bg-soft-dark text-sm">Logout</button>
            </form>
        </div>

    </div>
</header>
