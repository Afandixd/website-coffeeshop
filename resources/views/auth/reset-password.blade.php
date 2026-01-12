<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-amber-100 to-amber-300">

<div class="w-full max-w-md bg-white rounded-xl shadow-xl p-8">
    <h2 class="text-2xl font-bold text-center mb-6">
        Reset Password
    </h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4 text-sm">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <label class="block text-sm text-gray-600 mb-1">Email</label>
            <input
                type="email"
                name="email"
                value="{{ old('email', $request->email) }}"
                required
                class="w-full px-4 py-3 rounded-lg bg-gray-100 focus:ring-2 focus:ring-amber-400 outline-none"
            >
        </div>

        <div>
            <label class="block text-sm text-gray-600 mb-1">Password Baru</label>
            <input
                type="password"
                name="password"
                required
                class="w-full px-4 py-3 rounded-lg bg-gray-100 focus:ring-2 focus:ring-amber-400 outline-none"
            >
        </div>

        <div>
            <label class="block text-sm text-gray-600 mb-1">Konfirmasi Password</label>
            <input
                type="password"
                name="password_confirmation"
                required
                class="w-full px-4 py-3 rounded-lg bg-gray-100 focus:ring-2 focus:ring-amber-400 outline-none"
            >
        </div>

        <button
            type="submit"
            class="w-full bg-amber-500 hover:bg-amber-600 text-white py-3 rounded-lg font-semibold transition"
        >
            Reset Password
        </button>
    </form>
</div>

</body>
</html>
