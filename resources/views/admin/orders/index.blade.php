@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Daftar Order</h2>
        <a href="/admin/dashboard" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
            Kembali ke Dashboard
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Items</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($orders as $order)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">#{{ $order->id }}</td>
                    <td class="px-6 py-4">{{ $order->user->name }}</td>
                    <td class="px-6 py-4">
                        @if($order->status == 'pending')
                            <span class="px-2 py-1 text-xs font-semibold rounded bg-yellow-100 text-yellow-800">Pending</span>
                        @elseif($order->status == 'paid')
                            <span class="px-2 py-1 text-xs font-semibold rounded bg-blue-100 text-blue-800">Paid</span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold rounded bg-green-100 text-green-800">Done</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        @if($order->orderItems->count() > 0)
                            <ul class="text-sm text-gray-600">
                                @foreach ($order->orderItems as $item)
                                    <li>{{ $item->product->name ?? 'Produk dihapus' }} x {{ $item->quantity }}</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-gray-400 text-sm italic">Data lama (tidak ada detail)</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $order->created_at->format('d M Y H:i') }}
                    </td>
                    <td class="px-6 py-4">
                        <form action="/admin/orders/{{ $order->id }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            @method('PUT')

                            <select name="status" class="border rounded px-2 py-1 text-sm">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="done" {{ $order->status == 'done' ? 'selected' : '' }}>Done</option>
                            </select>

                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                Update
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                        Belum ada order
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
