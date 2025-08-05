<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon">
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

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-100 to-purple-200">

    <div class="bg-white p-8 rounded shadow w-full max-w-sm animate-fade">
        <h1 class="text-2xl font-bold mb-6 text-center">Login</h1>

        @if ($errors->any())
            <div id="alert" class="flex items-center justify-between bg-red-100 text-red-800 p-3 rounded mb-4 animate-fade">
                <span>{{ $errors->first() }}</span>
                <button type="button" onclick="closeAlert()" class="font-bold px-2">×</button>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1">Email</label>
                <input type="email" name="email" required value="{{ old('email') }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>

            <div>
                <label class="block mb-1">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="password" required
                           class="w-full border border-gray-300 rounded px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                    
                    <button type="button" onclick="togglePassword()" 
                            class="absolute right-2 top-2 text-gray-500 hover:text-blue-600 transition-colors">
                        <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z" />
                            <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.5" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 5l1.5 2M8 4l1 2M12 3v2M16 4l-1 2M20 5l-1.5 2" />
                        </svg>

                        <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2 12s4-5 10-5 10 5 10 5-4 5-10 5S2 12 2 12z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 9c2-2 6-3 8-3s6 1 8 3" />
                        </svg>
                    </button>
                </div>
            </div>

            <button type="submit" id="loginButton"
                    class="w-full bg-purple-500 hover:bg-purple-600 text-white py-2 rounded transition-colors duration-200 flex items-center justify-center relative">
                <span id="buttonText">Masuk</span>
                <svg id="spinner" class="animate-spin h-5 w-5 ml-2 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
            </button>

            <div class="text-center text-gray-500 text-sm mt-4">
                &copy; {{ date('Y') }} Aplikasi Manajemen Barang. <br> All rights reserved.
            </div>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const eyeOpen = document.getElementById("eyeOpen");
            const eyeClosed = document.getElementById("eyeClosed");

            const isHidden = passwordInput.type === "password";
            passwordInput.type = isHidden ? "text" : "password";
            eyeOpen.classList.toggle("hidden", !isHidden);
            eyeClosed.classList.toggle("hidden", isHidden);
        }

        function closeAlert() {
            const alert = document.getElementById('alert');
            if (alert) {
                alert.classList.remove('animate-fade');
                alert.classList.add('animate-out');
                alert.addEventListener('animationend', () => alert.remove(), { once: true });
            }
        }

        const form = document.querySelector('form');
        form.addEventListener('submit', () => {
            const loginButton = document.getElementById('loginButton');
            const buttonText = document.getElementById('buttonText');
            const spinner = document.getElementById('spinner');

            loginButton.disabled = true;
            buttonText.classList.add('hidden');
            spinner.classList.remove('hidden');
        });
    </script>

</body>
</html>
