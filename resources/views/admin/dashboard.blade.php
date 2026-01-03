@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h2 class="text-3xl font-bold mb-8">Dashboard Admin</h2>

    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Produk -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Produk</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalProducts }}</p>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
            </div>
            <a href="/admin/products" class="text-blue-600 text-sm mt-4 inline-block hover:underline">
                Lihat semua produk →
            </a>
        </div>

        <!-- Total Order -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Order</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalOrders }}</p>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
            </div>
            <a href="/admin/orders" class="text-green-600 text-sm mt-4 inline-block hover:underline">
                Lihat semua order →
            </a>
        </div>

        <!-- Order Pending -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Order Pending</p>
                    <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $pendingOrders }}</p>
                </div>
                <div class="bg-yellow-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <a href="/admin/orders" class="text-yellow-600 text-sm mt-4 inline-block hover:underline">
                Proses sekarang →
            </a>
        </div>

        <!-- Order Selesai -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Order Selesai</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ $doneOrders }}</p>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <h3 class="text-xl font-semibold mb-4">Quick Actions</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="/admin/products/create" class="border-2 border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white font-semibold py-3 px-6 rounded text-center transition">
                + Tambah Produk Baru
            </a>
            <a href="/admin/products" class="border-2 border-gray-500 text-gray-500 hover:bg-gray-500 hover:text-white font-semibold py-3 px-6 rounded text-center transition">
                Kelola Produk
            </a>
            <a href="/admin/orders" class="border-2 border-green-500 text-green-500 hover:bg-green-500 hover:text-white font-semibold py-3 px-6 rounded text-center transition">
                Kelola Order
            </a>
        </div>
    </div>

    <!-- Daftar Produk -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-xl font-semibold">Daftar Produk</h3>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stok</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($products as $product)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $product->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($product->stock > 10)
                            <span class="text-green-600 font-semibold">{{ $product->stock }}</span>
                        @elseif($product->stock > 0)
                            <span class="text-yellow-600 font-semibold">{{ $product->stock }}</span>
                        @else
                            <span class="text-red-600 font-semibold">Habis</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="/admin/products/{{ $product->id }}/edit" class="text-blue-600 hover:underline mr-3">Edit</a>
                        <form action="/admin/products/{{ $product->id }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Yakin hapus produk ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                        Belum ada produk
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
