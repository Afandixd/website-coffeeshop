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
        <th>Aksi</th>
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
        <td>
            <form action="/admin/orders/{{ $order->id }}" method="POST">
                @csrf
                @method('PUT')

                <select name="status">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>pending</option>
                    <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>paid</option>
                    <option value="done" {{ $order->status == 'done' ? 'selected' : '' }}>done</option>
                </select>

                <button type="submit">Update</button>
            </form>
        </td>
    </tr>
    @endforeach

</table>

</body>
</html>
