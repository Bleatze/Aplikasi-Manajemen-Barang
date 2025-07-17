<aside 
    x-data 
    :class="sidebarOpen ? 'w-64' : 'w-16'" 
    class="bg-ob h-screen p-4 space-y-4 text-white transition-all duration-300 overflow-y-auto fixed top-16 left-0 z-40"
>
    {{-- Menu Section --}}
    <h2 x-show="sidebarOpen" class="font-semibold text-white">Menu</h2>
    
    <a href="{{ route('dashboard') }}"
       title="Dashboard"
       class="flex items-center gap-2 p-2 rounded transition hover:translate-x-1 
       {{ request()->routeIs('dashboard') ? 'bg-purple-500 text-white shadow-inner ring-2 ring-purple-300
' : 'hover:bg-purple-600' }}">
        <img src="https://api.iconify.design/lucide/layout-dashboard.svg?color=white" alt="Dashboard" class="w-5 h-5">
        <span x-show="sidebarOpen" class="transition-all">Dashboard</span>
    </a>

    <a href="{{ route('users.index') }}"
       title="Manajemen User"
       class="flex items-center gap-2 p-2 rounded transition hover:translate-x-1 
       {{ request()->routeIs('users.*') ? 'bg-purple-500 text-white shadow-inner ring-2 ring-purple-300
' : 'hover:bg-purple-600' }}">
        <img src="https://api.iconify.design/lucide/users.svg?color=white" alt="Users" class="w-5 h-5">
        <span x-show="sidebarOpen" class="transition-all">Manajemen User</span>
    </a>

    <hr class="border-gray-600" />

    {{-- Master Data Section --}}
    <h2 x-show="sidebarOpen" class="font-semibold text-white">Master Data</h2>

    @foreach ([
        ['kategori.index', 'lucide/shapes', 'Kategori'],
        ['satuan.index', 'lucide/scale', 'Satuan'],
        ['barang.index', 'lucide/package', 'Barang'],
    ] as [$route, $icon, $label])
        <a href="{{ route($route) }}"
           title="{{ $label }}"
           class="flex items-center gap-2 p-2 rounded transition hover:translate-x-1 
           {{ request()->routeIs(Str::before($route, '.') . '.*') ? 'bg-purple-500 text-white shadow-inner ring-2 ring-purple-300
' : 'hover:bg-purple-600' }}">
            <img src="https://api.iconify.design/{{ $icon }}.svg?color=white" alt="{{ $label }}" class="w-5 h-5">
            <span x-show="sidebarOpen" class="transition-all">{{ $label }}</span>
        </a>
    @endforeach

    <hr class="border-gray-600" />

    {{-- Transaksi Section --}}
    <h2 x-show="sidebarOpen" class="font-semibold text-white">Transaksi</h2>

    <a href="{{ route('barang-masuk.index') }}"
       title="Barang Masuk"
       class="flex items-center gap-2 p-2 rounded transition hover:translate-x-1 
       {{ request()->routeIs('barang-masuk.*') ? 'bg-purple-500 text-white shadow-inner ring-2 ring-purple-300
' : 'hover:bg-purple-600' }}">
        <img src="https://api.iconify.design/lucide/download.svg?color=white" alt="Barang Masuk" class="w-5 h-5">
        <span x-show="sidebarOpen" class="transition-all">Barang Masuk</span>
    </a>

    <a href="{{ route('barang-keluar.index') }}"
       title="Barang Keluar"
       class="flex items-center gap-2 p-2 rounded transition hover:translate-x-1 
       {{ request()->routeIs('barang-keluar.*') ? 'bg-purple-500 text-white shadow-inner ring-2 ring-purple-300
' : 'hover:bg-purple-600' }}">
        <img src="https://api.iconify.design/lucide/upload.svg?color=white" alt="Barang Keluar" class="w-5 h-5">
        <span x-show="sidebarOpen" class="transition-all">Barang Keluar</span>
    </a>

    <hr class="border-gray-600" />

    {{-- Laporan --}}
    <h2 x-show="sidebarOpen" class="font-semibold text-white">Lainnya</h2>

    <a href="{{ route('laporan.index') }}"
       title="Laporan"
       class="flex items-center gap-2 p-2 rounded transition hover:translate-x-1 
       {{ request()->routeIs('laporan.*') ? 'bg-purple-500 text-white shadow-inner ring-2 ring-purple-300
' : 'hover:bg-purple-600' }}">
        <img src="https://api.iconify.design/lucide/file-bar-chart.svg?color=white" alt="Laporan" class="w-5 h-5">
        <span x-show="sidebarOpen" class="transition-all">Laporan</span>
    </a>
</aside>
