<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded">
                <h3 class="text-lg font-bold mb-4">Statistik</h3>
                <ul class="list-disc pl-5 mb-4">
                    <li>Total Produk: <strong>{{ $totalProducts }}</strong></li>
                    <li>Total Order: <strong>{{ $totalOrders }}</strong></li>
                    <li>Order Pending: <strong>{{ $pendingOrders }}</strong></li>
                    <li>Order Selesai: <strong>{{ $doneOrders }}</strong></li>
                </ul>

                <div class="space-y-2">
                    <a href="{{ url('/admin/products') }}" class="bg-black text-white px-4 py-2 rounded block w-max hover:bg-gray-800">Kelola Produk</a>
                    <a href="{{ url('/admin/products/create') }}" class="bg-black text-white px-4 py-2 rounded block w-max hover:bg-gray-800">Tambah Produk</a>
                    <a href="{{ url('/admin/orders') }}" class="bg-black text-white px-4 py-2 rounded block w-max hover:bg-gray-800">Kelola Pesanan</a>
                    <a href="{{ url('/checkout') }}" class="bg-black text-white px-4 py-2 rounded block w-max hover:bg-gray-800">Buat Order Baru</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
