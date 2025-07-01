<aside class="w-64 bg-white shadow h-screen p-6 space-y-4 hidden md:block">
    <a href="{{ route('dashboard') }}" class="block hover:text-blue-500">Dashboard</a>
    <hr>
    <h2 class="font-semibold">Master Data</h2>
    <a href="{{ route('kategori.index') }}" class="block hover:text-blue-500">Kategori</a>
    <a href="{{ route('satuan.index') }}" class="block hover:text-blue-500">Satuan</a>
    <a href="{{ route('barang.index') }}" class="block hover:text-blue-500">Barang</a>
    <hr>
    <a href="{{ route('barang-masuk.index') }}" class="block hover:text-blue-500">Barang Masuk</a>
    <a href="{{ route('barang-keluar.index') }}" class="block hover:text-blue-500">Barang Keluar</a>
    <hr>
    <a href="{{ route('laporan.index') }}" class="block hover:text-blue-500">Laporan</a>
    <a href="{{ route('users.index') }}" class="block hover:text-blue-500">Manajemen User</a>
</aside>
