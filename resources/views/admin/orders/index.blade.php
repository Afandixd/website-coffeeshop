<!DOCTYPE html>
<html>
<head>
    <title>Daftar Order</title>
</head>
<body>

<h2>Daftar Order</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>User</th>
        <th>Status</th>
        <th>Total</th>
        <th>Detail</th>
    </tr>

    @foreach ($orders as $order)
    <tr>
        <td>{{ $order->id }}</td>
        <td>{{ $order->user->name }}</td>
        <td>{{ $order->status }}</td>
        <td>{{ $order->total_price }}</td>
        <td>
            <ul>
                @foreach ($order->orderItems as $item)
                    <li>
                        {{ $item->product->name }} x {{ $item->quantity }}
                    </li>
                @endforeach
            </ul>
        </td>
    </tr>
    @endforeach

</table>

</body>
</html>
