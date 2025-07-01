<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded shadow w-full max-w-sm">
        <h1 class="text-2xl font-bold mb-6 text-center">Login</h1>

        {{-- Dummy alert --}}
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4 hidden">
            Email atau password salah.
        </div>

        <form onsubmit="event.preventDefault(); window.location.href='{{ route('dashboard') }}';" class="space-y-4">
            <div>
                <label class="block mb-1">Email</label>
                <input type="email" name="email" required class="w-full border-gray-300 rounded px-3 py-2 shadow-sm">
            </div>

            <div>
                <label class="block mb-1">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="password" required class="w-full border-gray-300 rounded px-3 py-2 shadow-sm pr-10">
                    <button type="button" onclick="togglePassword()" class="absolute right-2 top-2 text-gray-500 hover:text-gray-700 text-sm">
                        Show
                    </button>
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                Masuk
            </button>

            <p class="text-center text-sm mt-4">
                Tidak punya akun?
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-medium">Register</a>
            </p>
        </form>
    </div>

    {{-- Toggle password script --}}
    <script>
        function togglePassword() {
            const input = document.getElementById("password");
            const isHidden = input.type === "password";
            input.type = isHidden ? "text" : "password";
            event.target.textContent = isHidden ? "Hide" : "Show";
        }
    </script>
</body>
</html>
    