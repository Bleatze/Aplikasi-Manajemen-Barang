<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Aplikasi Barang')</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans&display=swap" rel="stylesheet">
    
</head>
<body class="font-sans bg-soft-light text-accent min-h-screen  bg-gradient-to-br from-blue-300 to-purple-300">

    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Body --}}
    <div class="flex">
        {{-- Sidebar --}}
        @include('partials.sidebar')

        {{-- Konten utama --}}
        <main class="flex-1 p-6">
            @include('partials.alert')
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
@yield('scripts')
</html>
    