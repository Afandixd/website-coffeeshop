<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You - Coffee Shop</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-50">

    <!-- Header -->
    <div class="bg-white border-b shadow-sm">
        <div class="max-w-4xl mx-auto px-6 py-4">
            <div class="flex items-center justify-center gap-2">
                <span class="text-green-600 text-2xl">☘️</span>
                <h1 class="text-xl font-bold text-gray-800" style="font-family: cursive;">Coffee Shop</h1>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="bg-white rounded-lg shadow-lg p-12 w-full max-w-md text-center">

            <!-- Success Icon -->
            <div class="mb-6">
                <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto">
                    <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
            </div>

            <h2 class="text-3xl font-bold text-gray-800 mb-4">Pesanan Akan Segera Diproses, Mohon Bersabar!</h2>

            <p class="text-gray-600 mb-8">
                Silahkan tukar pesanan anda dengan staff kami dan jangan lupa tunjukkan bukti pembayaran.
            </p>

            <!-- Action Buttons -->
            <div class="space-y-3">
                <a
                    href="{{ url('/my-orders') }}"
                    class="block w-full bg-green-500 hover:bg-green-600 text-black font-bold py-3 rounded-lg transition-all duration-300 shadow-md"
                >
                    Lihat Pesanan Saya
                </a>

                <a
                    href="{{ url('/products') }}"
                    class="block w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 rounded-lg transition"
                >
                    Kembali ke Menu
                </a>
            </div>
        </div>
    </div>

</body>
</html>
