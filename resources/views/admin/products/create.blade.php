<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
</head>
<body>

<h1>Tambah Produk</h1>

<a href="/admin/products">Kembali</a>

<form action="/admin/products" method="POST">
    @csrf

    <div>
        <label>Nama</label><br>
        <input type="text" name="name" required>
    </div>

    <div>
        <label>Harga</label><br>
        <input type="number" name="price" required>
    </div>

    <div>
        <label>Stok</label><br>
        <input type="number" name="stock" required>
    </div>

    <button type="submit">Simpan</button>
</form>

</body>
</html>
