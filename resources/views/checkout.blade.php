@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Checkout</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/checkout') }}">
        @csrf

        <div class="bg-white shadow rounded-lg overflow-hidden mb-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stok</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($products as $product)
                        <tr>
                            <td class="px-6 py-4">{{ $product->name }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                @if($product->stock > 0)
                                    <span class="text-green-600">{{ $product->stock }}</span>
                                @else
                                    <span class="text-red-600">Habis</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($product->stock > 0)
                                    <input
                                        type="number"
                                        name="items[{{ $product->id }}][quantity]"
                                        min="0"
                                        max="{{ $product->stock }}"
                                        value="0"
                                        class="border rounded px-3 py-2 w-20"
                                    >
                                    <input type="hidden" name="items[{{ $product->id }}][product_id]" value="{{ $product->id }}">
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-black font-semibold px-6 py-3 rounded">
                Buat Order
            </button>
        </div>
    </form>
</div>
@endsection
