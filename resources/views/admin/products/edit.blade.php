<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
</head>
<body>

<h1>Edit Produk</h1>

<a href="/admin/products">Kembali</a>

<form action="/admin/products/{{ $product->id }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label>Nama</label><br>
        <input type="text" name="name" value="{{ $product->name }}" required>
    </div>

    <div>
        <label>Harga</label><br>
        <input type="number" name="price" value="{{ $product->price }}" required>
    </div>

    <div>
        <label>Stok</label><br>
        <input type="number" name="stock" value="{{ $product->stock }}" required>
    </div>

    <button type="submit">Update</button>
</form>

</body>
</html>
