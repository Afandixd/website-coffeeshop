<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-amber-100 to-amber-300">

<div class="w-full max-w-md bg-white rounded-xl shadow-xl p-8">
    <h2 class="text-2xl font-bold text-center mb-4">
        Lupa Password
    </h2>

    <p class="text-sm text-gray-600 text-center mb-6">
        Masukkan email untuk reset password
    </p>

    @if (session('status'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4 text-sm">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4 text-sm">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
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
            >
        </div>

        <button
            type="submit"
            class="w-full bg-amber-500 hover:bg-amber-600 text-white py-3 rounded-lg font-semibold transition"
        >
            Kirim Link Reset
        </button>
    </form>

    <div class="text-center mt-6 text-sm">
        <a href="{{ route('login') }}" class="text-amber-600 hover:underline">
            Kembali ke Login
        </a>
    </div>
</div>

</body>
</html>
