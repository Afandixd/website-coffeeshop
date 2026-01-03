@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">Histori Order Saya</h2>

<table class="table-auto border-collapse border border-gray-400 w-full">
    <thead>
        <tr class="bg-gray-200">
            <th class="border px-4 py-2">ID Order</th>
            <th class="border px-4 py-2">Status</th>
            <th class="border px-4 py-2">Total Harga</th>
            <th class="border px-4 py-2">Item</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <td class="border px-4 py-2">{{ $order->id }}</td>
                <td class="border px-4 py-2">{{ $order->status }}</td>
                <td class="border px-4 py-2">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                <td class="border px-4 py-2">
                    <ul>
                        @foreach ($order->orderItems as $item)
                            <li>{{ $item->product->name }} x {{ $item->quantity }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
