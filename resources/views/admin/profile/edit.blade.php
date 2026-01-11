<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Coffee Shop</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100">

    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <span class="text-green-600 text-2xl">☘️</span>
                <h1 class="text-xl font-bold text-gray-800" style="font-family: cursive;">Coffee Shop</h1>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="text-green-600 hover:text-green-700">
                ← Back to Dashboard
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md">

            <!-- Avatar with Initial -->
            <div class="flex justify-center mb-6">
                <div class="w-24 h-24 rounded-full bg-gray-300 flex items-center justify-center border-4 border-white shadow-lg relative">
                    <span class="text-4xl font-bold text-gray-700">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </span>
                    <!-- Plus Icon -->
                    <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-white rounded-full border-2 border-gray-300 flex items-center justify-center shadow-md">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                </div>
            </div>

            <h2 class="text-center text-2xl font-bold mb-6">Admin</h2>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

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

            <!-- Edit Profile Form -->
            <form method="POST" action="{{ route('admin.profile.update') }}">
                @csrf
                @method('PUT')

                <!-- Username/Name -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        required
                        class="w-full px-4 py-3 bg-gray-200 border-none rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Enter your username"
                    >
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        required
                        class="w-full px-4 py-3 bg-gray-200 border-none rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Enter your email"
                    >
                </div>

                <!-- New Password -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru (opsional)</label>
                    <input
                        type="password"
                        name="password"
                        class="w-full px-4 py-3 bg-gray-200 border-none rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Leave blank to keep current password"
                    >
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        class="w-full px-4 py-3 bg-gray-200 border-none rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Confirm new password"
                    >
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-3 rounded-lg transition-all duration-300 transform hover:scale-105 shadow-md"
                >
                    DONE
                </button>
            </form>
        </div>
    </div>

</body>
</html>
