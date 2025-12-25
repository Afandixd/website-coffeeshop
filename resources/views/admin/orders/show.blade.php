<h1>Detail Order #{{ $order->id }}</h1>

<p>User: {{ $order->user->name }}</p>
<p>Status: {{ $order->status }}</p>
<p>Total: {{ $order->total_price }}</p>

<form method="POST" action="/admin/orders/{{ $order->id }}">
    @csrf
    @method('PUT')

    <select name="status">
        <option value="pending">pending</option>
        <option value="paid">paid</option>
        <option value="done">done</option>
        <option value="cancelled">cancelled</option>
    </select>

    <button type="submit">Update Status</button>
</form>

<h3>Item</h3>
<ul>
    @foreach ($order->orderItems as $item)
        <li>
            {{ $item->product->name }} |
            {{ $item->quantity }} |
            {{ $item->price }}
        </li>
    @endforeach
</ul>
