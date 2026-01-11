<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products - Coffee Shop</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-white">

    <!-- Header -->
    <div class="bg-white border-b shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center gap-2">
                <span class="text-green-600 text-2xl">☘️</span>
                <h1 class="text-xl font-bold text-gray-800" style="font-family: cursive;">Coffee Shop</h1>
            </div>

            <!-- Admin Menu -->
            <div class="flex items-center gap-4">
                <a href="{{ url('/admin/dashboard') }}" class="text-gray-600 hover:text-green-600 transition">
                    Dashboard
                </a>
                <a href="{{ url('/admin/orders') }}" class="text-gray-600 hover:text-green-600 transition">
                    Orders
                </a>
                <a href="{{ url('/admin/tables') }}" class="text-gray-600 hover:text-green-600 transition">
                    Tables
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-gray-600 hover:text-red-600 transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-6 py-8">

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- Products Grid (3 columns, 2 rows) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- Add New Product Card -->
            <a href="{{ url('/admin/products/create') }}" class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 border-2 border-dashed border-gray-300 hover:border-green-500 flex items-center justify-center min-h-[300px]">
                <div class="text-center">
                    <div class="w-20 h-20 mx-auto mb-4 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <p class="text-lg font-semibold text-gray-600">Tambah Produk</p>
                </div>
            </a>

            <!-- Existing Products -->
            @foreach ($products as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <!-- Product Image -->
                    <div class="relative h-48 bg-gradient-to-br from-amber-100 to-orange-200 flex items-center justify-center overflow-hidden">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        @else
                            <svg class="w-20 h-20 text-orange-400 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                            </svg>
                        @endif

                        <!-- Edit Harga Badge -->
                        <div class="absolute top-2 right-2">
                            <span class="bg-green-500 text-black text-xs font-bold px-3 py-1 rounded shadow-md">
                                Edit Harga
                            </span>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-600 mb-1">
                            <strong>Harga:</strong> Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                        <p class="text-sm text-gray-600 mb-4">
                            <strong>Stok:</strong>
                            <span class="{{ $product->stock > 10 ? 'text-green-600' : ($product->stock > 0 ? 'text-yellow-600' : 'text-red-600') }} font-semibold">
                                {{ $product->stock }}
                            </span>
                        </p>

                        <!-- Action Buttons -->
                        <div class="flex gap-2">
                            <a href="{{ url('/admin/products/' . $product->id . '/edit') }}"
                               class="flex-1 bg-blue-500 hover:bg-blue-600 text-white text-center font-semibold px-4 py-2 rounded transition">
                                Tambah keterangan +
                            </a>
                        </div>

                        <!-- Delete Button -->
                        <form method="POST" action="{{ url('/admin/products/' . $product->id) }}" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                onclick="return confirm('Yakin hapus {{ $product->name }}?')"
                                class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded transition"
                            >
                                Hapus Produk
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        @if($products->isEmpty())
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">Belum ada produk. Klik tombol "Tambah Produk" untuk menambahkan.</p>
            </div>
        @endif
    </div>

</body>
</html>
