<!DOCTYPE html>
<html>
<head>
    <title>Admin Products</title>
</head>
<body>

<h1>Daftar Produk</h1>

<a href="/admin/products/create">Tambah Produk</a>

<table border="1" cellpadding="8">
    <tr>
        <th>Nama</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>

    @foreach ($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>
                <a href="/admin/products/{{ $product->id }}/edit">Edit</a>

                <form action="/admin/products/{{ $product->id }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

</body>
</html>
