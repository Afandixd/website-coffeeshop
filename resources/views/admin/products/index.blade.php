<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products - Coffee Shop</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-white text-black">

<div class="bg-white border-b shadow-sm">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">Coffee Shop Culture</h1>

        <div class="flex items-center gap-4">
            <a href="{{ url('/admin/dashboard') }}">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-6 py-8">

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        <a
            href="{{ url('/admin/products/create') }}"
            class="bg-white rounded-lg shadow-md border-2 border-dashed border-gray-300 flex items-center justify-center min-h-[360px]"
        >
            <p class="text-lg font-semibold">Tambah Produk</p>
        </a>

        @foreach ($products as $product)
        <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col">

            <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                <img
                    src="{{ asset('storage/'.$product->image) }}"
                    alt="{{ $product->name }}"
                    class="w-32 h-32 object-cover"
                >
            </div>

            <div class="p-4 text-center flex flex-col gap-1">
                <h3 class="font-bold">{{ $product->name }}</h3>

                <p>
                    Harga Rp {{ number_format($product->price,0,',','.') }}
                </p>

                <p>
                    Stok {{ $product->stock }}
                </p>

                <a
                    href="{{ url('/admin/products/'.$product->id.'/edit') }}"
                    class="mt-3 bg-blue-500 text-black py-2 rounded"
                >
                    Edit Produk
                </a>

                <form
                    method="POST"
                    action="{{ url('/admin/products/'.$product->id) }}"
                    class="mt-2"
                >
                    @csrf
                    @method('DELETE')
                    <button class="w-full bg-red-500 text-black py-2 rounded">
                        Hapus
                    </button>
                </form>
            </div>

        </div>
        @endforeach

    </div>
</div>

</body>
</html>
