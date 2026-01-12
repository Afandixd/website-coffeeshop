<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-amber-100 to-amber-300">

<div class="w-full max-w-md bg-white rounded-xl shadow-xl p-8">
    <h2 class="text-2xl font-bold text-center mb-4">
        Verifikasi Email
    </h2>

    <p class="text-sm text-gray-600 text-center mb-6">
        Cek email kamu dan klik link verifikasi
    </p>

    @if (session('status') === 'verification-link-sent')
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4 text-sm text-center">
            Link verifikasi baru sudah dikirim
        </div>
    @endif

    <div class="space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button
                type="submit"
                class="w-full bg-amber-500 hover:bg-amber-600 text-white py-3 rounded-lg font-semibold transition"
            >
                Kirim Ulang Email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                type="submit"
                class="w-full text-gray-600 hover:underline text-sm"
            >
                Logout
            </button>
        </form>
    </div>
</div>

</body>
</html>
