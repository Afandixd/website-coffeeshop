@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">Menu Kopi</h2>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    @foreach ($products as $product)
        <div class="p-4 bg-white shadow rounded">
            <h3 class="font-semibold">{{ $product->name }}</h3>
            <p>Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <p>Stok: {{ $product->stock }}</p>

            <form method="POST" action="{{ url('/checkout') }}" class="mt-2">
                @csrf
                <input type="hidden" name="items[0][product_id]" value="{{ $product->id }}">
                <input type="number" name="items[0][quantity]" min="1" value="1" class="border rounded px-2 py-1">
                <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Beli</button>
            </form>
        </div>
    @endforeach
</div>
@endsection
