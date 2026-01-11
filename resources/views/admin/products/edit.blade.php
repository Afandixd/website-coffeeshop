<form method="POST" action="{{ url('/admin/products/' . $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Current Image Preview -->
                @if($product->image)
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Saat Ini</label>
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-lg">
                    </div>
                @endif

                <!-- Product Image -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $product->image ? 'Ganti Gambar (Opsional)' : 'Gambar Produk (Opsional)' }}
                    </label>
                    <input
                        type="file"
                        name="image"
                        accept="image/*"
                        class="w-full px-4 py-3 bg-gray-200 border-none rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-green-500 file:text-black file:font-semibold hover:file:bg-green-600"
                    >
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF (Max: 2MB)</p>
                </div><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Coffee Shop</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-50">

    <!-- Header -->
    <div class="bg-white border-b shadow-sm">
        <div class="max-w-4xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <span class="text-green-600 text-2xl">☘️</span>
                <h1 class="text-xl font-bold text-gray-800" style="font-family: cursive;">Coffee Shop</h1>
            </div>
            <a href="{{ url('/admin/products') }}" class="text-green-600 hover:text-green-700">
                ← Back to Products
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md">

            <h2 class="text-2xl font-bold text-center mb-6">Edit Produk</h2>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ url('/admin/products/' . $product->id) }}">
                @csrf
                @method('PUT')

                <!-- Product Name -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Produk</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $product->name) }}"
                        required
                        class="w-full px-4 py-3 bg-gray-200 border-none rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                    >
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Harga
                        <span class="ml-2 px-2 py-1 bg-green-500 text-black text-xs font-bold rounded">Edit Harga</span>
                    </label>
                    <input
                        type="number"
                        name="price"
                        value="{{ old('price', $product->price) }}"
                        required
                        min="0"
                        step="100"
                        class="w-full px-4 py-3 bg-gray-200 border-none rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                    >
                </div>

                <!-- Stock -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Stok</label>
                    <input
                        type="number"
                        name="stock"
                        value="{{ old('stock', $product->stock) }}"
                        required
                        min="0"
                        class="w-full px-4 py-3 bg-gray-200 border-none rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                    >
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full bg-green-500 hover:bg-green-600 text-black font-bold py-3 rounded-lg transition-all duration-300 shadow-md"
                >
                    Update Produk
                </button>

                <!-- Cancel Button -->
                <a
                    href="{{ url('/admin/products') }}"
                    class="block w-full text-center bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-3 rounded-lg transition mt-3"
                >
                    Batal
                </a>
            </form>
        </div>
    </div>

</body>
</html>
