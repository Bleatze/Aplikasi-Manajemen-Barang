<aside class="w-64 bg-white shadow h-screen p-6 space-y-4 hidden md:block text-gray-700">

    <a href="{{ route('dashboard') }}"
       class="flex items-center gap-2 transform transition-all duration-200 hover:translate-x-1 p-2 rounded 
       {{ request()->routeIs('dashboard') ? 'bg-primary text-white' : 'hover:bg-blue-500/20' }}">
        <img src="https://api.iconify.design/mdi/view-dashboard.svg" alt="Dashboard" class="w-5 h-5">
        Dashboard
    </a>

    <a href="{{ route('users.index') }}"
       class="flex items-center gap-2 transform transition-all duration-200 hover:translate-x-1 p-2 rounded 
       {{ request()->routeIs('users.*') ? 'bg-primary text-white' : 'hover:bg-blue-500/20' }}">
        <img src="https://api.iconify.design/mdi/account-group.svg" alt="Users" class="w-5 h-5">
        Manajemen User
    </a>

    <hr>
    <h2 class="font-semibold text-gray-500">Master Data</h2>

    <a href="{{ route('kategori.index') }}"
       class="flex items-center gap-2 transform transition-all duration-200 hover:translate-x-1 p-2 rounded 
       {{ request()->routeIs('kategori.*') ? 'bg-primary text-white' : 'hover:bg-blue-500/20' }}">
        <img src="https://api.iconify.design/mdi:shape-outline.svg" alt="Kategori" class="w-5 h-5">
        Kategori
    </a>

    <a href="{{ route('satuan.index') }}"
       class="flex items-center gap-2 transform transition-all duration-200 hover:translate-x-1 p-2 rounded 
       {{ request()->routeIs('satuan.*') ? 'bg-primary text-white' : 'hover:bg-blue-500/20' }}">
        <img src="https://api.iconify.design/mdi:scale-balance.svg" alt="Satuan" class="w-5 h-5">
        Satuan
    </a>

    <a href="{{ route('barang.index') }}"
       class="flex items-center gap-2 transform transition-all duration-200 hover:translate-x-1 p-2 rounded 
       {{ request()->routeIs('barang.*') ? 'bg-primary text-white' : 'hover:bg-blue-500/20' }}">
        <img src="https://api.iconify.design/mdi:archive-outline.svg" alt="Barang" class="w-5 h-5">
        Barang
    </a>

    <hr>

    <a href="{{ route('barang-masuk.index') }}"
       class="flex items-center gap-2 transform transition-all duration-200 hover:translate-x-1 p-2 rounded 
       {{ request()->routeIs('barang-masuk.*') ? 'bg-primary text-white' : 'hover:bg-blue-500/20' }}">
        <img src="https://api.iconify.design/mdi:tray-arrow-down.svg" alt="Barang Masuk" class="w-5 h-5">
        Barang Masuk
    </a>

    <a href="{{ route('barang-keluar.index') }}"
       class="flex items-center gap-2 transform transition-all duration-200 hover:translate-x-1 p-2 rounded 
       {{ request()->routeIs('barang-keluar.*') ? 'bg-primary text-white' : 'hover:bg-blue-500/20' }}">
        <img src="https://api.iconify.design/mdi:tray-arrow-up.svg" alt="Barang Keluar" class="w-5 h-5">
        Barang Keluar
    </a>

    <hr>

    <a href="{{ route('laporan.index') }}"
       class="flex items-center gap-2 transform transition-all duration-200 hover:translate-x-1 p-2 rounded 
       {{ request()->routeIs('laporan.*') ? 'bg-primary text-white' : 'hover:bg-blue-500/20' }}">
        <img src="https://api.iconify.design/mdi:file-chart-outline.svg" alt="Laporan" class="w-5 h-5">
        Laporan
    </a>

</aside>
