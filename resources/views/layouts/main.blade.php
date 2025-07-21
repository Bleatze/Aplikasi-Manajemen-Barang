<!DOCTYPE html>
<html lang="en" x-data="{
    sidebarOpen: JSON.parse(localStorage.getItem('sidebarOpen')) ?? true,
    toggleSidebar() {
        this.sidebarOpen = !this.sidebarOpen;
        localStorage.setItem('sidebarOpen', JSON.stringify(this.sidebarOpen));
    }
}" x-cloak>

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Aplikasi Barang')</title>

    @vite('resources/css/app.css')
    <script defer src="https://unpkg.com/alpinejs"></script>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans&display=swap" rel="stylesheet">

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: translateY(0);
            }

            to {
                opacity: 0;
                transform: translateY(5px);
            }
        }

        .animate-fade {
            animation: fadeIn 0.3s ease-out;
        }

        .animate-out {
            animation: fadeOut 0.3s ease-out;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
    @stack('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

</head>

<body class="font-sans  bg-ob">


    <div class="flex flex-col h-screen">

        {{-- Navbar --}}
        <header class="fixed top-0 left-0 right-0 z-50 bg-ob h-16 flex items-center px-4 ml-1.5">
            {{-- Toggle sidebar --}}
            <button @click="toggleSidebar()" class="mr-4 focus:outline-none">
                <span x-show="!sidebarOpen" x-cloak class="inline-flex items-center gap-1">
                    <!-- Ikon menu -->
                    <img src="https://api.iconify.design/lucide:menu.svg?color=white" class="w-5 h-5" />
                </span>
                <span x-show="sidebarOpen" x-cloak class="inline-flex items-center gap-1">
                    <!-- Ikon menu + panah kiri -->
                    <img src="https://api.iconify.design/material-symbols/menu-open-rounded.svg?color=white"
                        class="w-6 h-6 text-purple-600" />
                </span>
            </button>

            @include('partials.navbar')
        </header>

        <div class="flex flex-1 pt-16 overflow-hidden">

            {{-- Sidebar --}}
            <aside :class="sidebarOpen ? 'w-64' : 'w-16'"
                class="bg-white shadow h-full fixed md:relative z-40 transition-all duration-300 overflow-y-auto">
                @include('partials.sidebar')
            </aside>

            {{-- Main Content --}}
            <main :class="sidebarOpen" class="transition-all duration-300 flex-1 overflow-y-hidden pl-2 pt-1">
                <div class="bg-white rounded-tl-2xl shadow py-6 pl-6 pr-2 h-[calc(100vh-4rem)] flex flex-col">
                    @include('partials.alert')

                    <div class="overflow-y-auto flex-1">
                        @yield('content')
                    </div>
                </div>
            </main>


        </div>

    </div>

    <script>
        function closeAlert(button) {
            const alert = button.closest('.alert');
            if (alert) {
                alert.classList.remove('animate-fade');
                alert.classList.add('animate-out');
                alert.addEventListener('animationend', () => alert.remove(), {
                    once: true
                });
            }
        }
    </script>

    @yield('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @stack('scripts')
</body>

</html>
