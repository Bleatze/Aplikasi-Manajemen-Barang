<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded shadow w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Register</h1>

        {{-- Notifikasi error dummy --}}
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4 hidden">
            Error: Email sudah digunakan.
        </div>

        <form class="space-y-4">
            <div>
                <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                <input type="text" class="w-full border-gray-300 rounded px-3 py-2 shadow-sm" placeholder="Nama">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" class="w-full border-gray-300 rounded px-3 py-2 shadow-sm" placeholder="Email">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Password</label>
                <input type="password" class="w-full border-gray-300 rounded px-3 py-2 shadow-sm" placeholder="Password">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Konfirmasi Password</label>
                <input type="password" class="w-full border-gray-300 rounded px-3 py-2 shadow-sm" placeholder="Ulangi Password">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                Daftar
            </button>
        </form>

        <p class="text-center text-sm mt-4">
            Sudah punya akun?
            <a href="/login" class="text-blue-600 hover:underline font-medium">Login di sini</a>
        </p>
    </div>
</body>
</html>
