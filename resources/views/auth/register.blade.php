<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Coffee Shop</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-amber-100 to-amber-300">

<div class="w-full max-w-md bg-white rounded-xl shadow-xl p-8">
    <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">
        Buat Akun
    </h2>
    <p class="text-center text-gray-500 mb-8">
        Daftar untuk mulai order
    </p>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4 text-sm">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm text-gray-600 mb-1">Nama</label>
            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                class="w-full px-4 py-3 rounded-lg bg-gray-100 focus:ring-2 focus:ring-amber-400 outline-none"
                placeholder="Nama lengkap"
            >
        </div>

        <div>
            <label class="block text-sm text-gray-600 mb-1">Email</label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                class="w-full px-4 py-3 rounded-lg bg-gray-100 focus:ring-2 focus:ring-amber-400 outline-none"
                placeholder="email@contoh.com"
            >
        </div>

        <div>
            <label class="block text-sm text-gray-600 mb-1">Password</label>
            <input
                type="password"
                name="password"
                required
                class="w-full px-4 py-3 rounded-lg bg-gray-100 focus:ring-2 focus:ring-amber-400 outline-none"
                placeholder="Password"
            >
        </div>

        <div>
            <label class="block text-sm text-gray-600 mb-1">Konfirmasi Password</label>
            <input
                type="password"
                name="password_confirmation"
                required
                class="w-full px-4 py-3 rounded-lg bg-gray-100 focus:ring-2 focus:ring-amber-400 outline-none"
                placeholder="Ulangi password"
            >
        </div>

        <button
            type="submit"
            class="w-full bg-amber-500 hover:bg-amber-600 text-white py-3 rounded-lg font-semibold transition"
        >
            Register
        </button>
    </form>

    <div class="text-center mt-6 text-sm text-gray-600">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-amber-600 font-semibold hover:underline">
            Login
        </a>
    </div>
</div>

</body>
</html>
