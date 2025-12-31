<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>
<body>

<h2>Checkout</h2>

<form method="POST" action="/checkout">
    @csrf

    @foreach ($products as $product)
        <div>
            <p>{{ $product->name }} | Rp {{ $product->price }}</p>
            <input type="number" name="items[{{ $product->id }}][quantity]" min="0" value="0">
            <input type="hidden" name="items[{{ $product->id }}][product_id]" value="{{ $product->id }}">
        </div>
    @endforeach

    <button type="submit">Buat Order</button>
</form>

</body>
</html>
