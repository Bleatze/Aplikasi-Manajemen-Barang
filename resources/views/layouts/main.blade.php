<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Aplikasi Barang')</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans&display=swap" rel="stylesheet">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-5px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeOut {
            from { opacity: 1; transform: translateY(0); }
            to { opacity: 0; transform: translateY(5px); }
        }
        .animate-fade {
            animation: fadeIn 0.3s ease-out;
        }
        .animate-out {
            animation: fadeOut 0.3s ease-out;
        }
    </style>
</head>
<body class="font-sans bg-haha">

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
    <script>
        function closeAlert(button) {
            const alert = button.closest('.alert');
            if (alert) {
                alert.classList.remove('animate-fade');
                alert.classList.add('animate-out');
                alert.addEventListener('animationend', () => alert.remove(), { once: true });
            }
        }        
    </script>
    @yield('scripts')
</body>
</html>
