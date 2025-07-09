<aside class="w-64 bg-ob shadow h-screen p-6 space-y-4 hidden md:block text-white">
     <h2 class="font-semibold text-white">Menu</h2>
    <a href="{{ route('dashboard') }}"
       class="flex items-center gap-2 transform transition-all duration-200 hover:translate-x-1 p-2 rounded 
       {{ request()->routeIs('dashboard') ? 'bg-primary text-white' : 'hover:bg-kk' }}">
        <img src="https://api.iconify.design/mdi/view-dashboard.svg?color=white" alt="Dashboard" class="w-5 h-5">
        Dashboard
    </a>

    <a href="{{ route('users.index') }}"
       class="flex items-center gap-2 transform transition-all duration-200 hover:translate-x-1 p-2 rounded 
       {{ request()->routeIs('users.*') ? 'bg-primary text-white' : 'hover:bg-kk' }}">
        <img src="https://api.iconify.design/mdi/account-group.svg?color=white" alt="Users" class="w-5 h-5">
        Manajemen User
    </a>

    <hr>
    <h2 class="font-semibold text-white">Master Data</h2>

    <a href="{{ route('kategori.index') }}"
       class="flex items-center gap-2 transform transition-all duration-200 hover:translate-x-1 p-2 rounded 
       {{ request()->routeIs('kategori.*') ? 'bg-primary text-white' : 'hover:bg-kk' }}">
        <img src="https://api.iconify.design/mdi:shape-outline.svg?color=white" alt="Kategori" class="w-5 h-5">
        Kategori
    </a>

    <a href="{{ route('satuan.index') }}"
       class="flex items-center gap-2 transform transition-all duration-200 hover:translate-x-1 p-2 rounded 
       {{ request()->routeIs('satuan.*') ? 'bg-primary text-white' : 'hover:bg-kk' }}">
        <img src="https://api.iconify.design/mdi:scale-balance.svg?color=white" alt="Satuan" class="w-5 h-5">
        Satuan
    </a>

    <a href="{{ route('barang.index') }}"
       class="flex items-center gap-2 transform transition-all duration-200 hover:translate-x-1 p-2 rounded 
       {{ request()->routeIs('barang.*') ? 'bg-primary text-white' : 'hover:bg-kk' }}">
        <img src="https://api.iconify.design/mdi:archive-outline.svg?color=white" alt="Barang" class="w-5 h-5">
        Barang
    </a>

    <hr>
     <h2 class="font-semibold text-white">Transaksi</h2>
    <a href="{{ route('barang-masuk.index') }}"
       class="flex items-center gap-2 transform transition-all duration-200 hover:translate-x-1 p-2 rounded 
       {{ request()->routeIs('barang-masuk.*') ? 'bg-primary text-white' : 'hover:bg-kk' }}">
        <img src="https://api.iconify.design/mdi:tray-arrow-down.svg?color=white" alt="Barang Masuk" class="w-5 h-5">
        Barang Masuk
    </a>

    <a href="{{ route('barang-keluar.index') }}"
       class="flex items-center gap-2 transform transition-all duration-200 hover:translate-x-1 p-2 rounded 
       {{ request()->routeIs('barang-keluar.*') ? 'bg-primary text-white' : 'hover:bg-kk' }}">
        <img src="https://api.iconify.design/mdi:tray-arrow-up.svg?color=white" alt="Barang Keluar" class="w-5 h-5">
        Barang Keluar
    </a>

    <hr>
     <h2 class="font-semibold text-white">Lainnya</h2>
    <a href="{{ route('laporan.index') }}"
       class="flex items-center gap-2 transform transition-all duration-200 hover:translate-x-1 p-2 rounded 
       {{ request()->routeIs('laporan.*') ? 'bg-primary text-white' : 'hover:bg-kk' }}">
        <img src="https://api.iconify.design/mdi:file-chart-outline.svg?color=white" alt="Laporan" class="w-5 h-5">
        Laporan
    </a>

</aside>
