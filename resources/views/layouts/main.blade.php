<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Aplikasi Barang')</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans&display=swap" rel="stylesheet">
</head>
<body class="font-sans bg-gradient-to-br from-blue-300 to-purple-300 min-h-screen text-accent">

    {{-- Navbar Tetap di Atas --}}
    <header class="fixed top-0 left-0 right-0 z-50 bg-white shadow">
        @include('partials.navbar')
    </header>

    <div class="flex pt-16"> {{-- Padding top menyesuaikan tinggi Navbar --}}
        
        {{-- Sidebar Tetap di Kiri --}}
        <aside class="w-64 bg-white shadow h-screen fixed top-16 left-0 z-40 hidden md:block">
            @include('partials.sidebar')
        </aside>

        {{-- Konten Utama --}}
        <main class="flex-1 p-6 md:ml-64 w-full">
            @include('partials.alert')
            @yield('content')
        </main>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @yield('scripts')
</body>
</html>
