<h1>Daftar Order</h1>

<table border="1">
    <tr>
        <th>ID</th>
        <th>User</th>
        <th>Status</th>
        <th>Total</th>
        <th>Aksi</th>
    </tr>

    @foreach ($orders as $order)
    <tr>
        <td>{{ $order->id }}</td>
        <td>{{ $order->user->name }}</td>
        <td>{{ $order->status }}</td>
        <td>{{ $order->total_price }}</td>
        <td>
            <a href="/admin/orders/{{ $order->id }}">Detail</a>
        </td>
    </tr>
    @endforeach
</table>
