<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Coffee Shop</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md">
        <!-- Header -->
        <h2 class="text-3xl font-bold text-center mb-8">Login</h2>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Username/Email -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="w-full px-4 py-3 bg-gray-200 border-none rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                    placeholder="Enter your email"
                >
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input
                    type="password"
                    name="password"
                    required
                    class="w-full px-4 py-3 bg-gray-200 border-none rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition"
                    placeholder="Enter your password"
                >
            </div>

            <!-- Remember Me -->
            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <!-- Login Button -->
            <button
                type="submit"
                class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-3 rounded-lg transition-all duration-300 transform hover:scale-105 shadow-md"
            >
                Login
            </button>
        </form>

        <!-- Register Link -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-green-600 hover:text-green-700 font-semibold">
                    Register here
                </a>
            </p>
        </div>
    </div>

</body>
</html>
