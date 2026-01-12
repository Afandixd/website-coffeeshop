<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Coffee Shop</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-amber-100 to-amber-300">

<div class="w-full max-w-md bg-white rounded-xl shadow-xl p-8">
    <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">
        Coffee Shop
    </h2>
    <p class="text-center text-gray-500 mb-8">
        Login ke akun kamu
    </p>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4 text-sm">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm text-gray-600 mb-1">Email</label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
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

        <div class="flex items-center justify-between text-sm">
            <label class="flex items-center gap-2">
                <input type="checkbox" name="remember" class="rounded text-amber-500">
                <span class="text-gray-600">Remember me</span>
            </label>
        </div>

        <button
            type="submit"
            class="w-full bg-amber-500 hover:bg-amber-600 text-white py-3 rounded-lg font-semibold transition"
        >
            Login
        </button>
    </form>

    <div class="text-center mt-6 text-sm text-gray-600">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-amber-600 font-semibold hover:underline">
            Register
        </a>
    </div>
</div>

</body>
</html>
