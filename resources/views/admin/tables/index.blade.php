@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Table Management</h2>
        <a href="{{ url('/admin/dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
            ← Back to Dashboard
        </a>
    </div>

    <!-- Legend -->
    <div class="flex gap-6 mb-6 bg-white p-4 rounded-lg shadow">
        <div class="flex items-center gap-2">
            <div class="w-4 h-4 bg-gray-400 rounded"></div>
            <span class="text-sm font-medium">Kosong</span>
        </div>
        <div class="flex items-center gap-2">
            <div class="w-4 h-4 bg-green-500 rounded"></div>
            <span class="text-sm font-medium">Terisi</span>
        </div>
    </div>

    <!-- Tables Grid -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="space-y-8">
            @for($row = 1; $row <= 3; $row++)
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">
                        Meja {{ ($row - 1) * 4 + 1 }} - {{ $row * 4 }}
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        @for($col = 1; $col <= 4; $col++)
                            @php
                                $tableNumber = ($row - 1) * 4 + $col;
                                $table = $tables->firstWhere('table_number', $tableNumber);
                                $isOccupied = $table && $table->status === 'occupied';
                            @endphp

                            @if($table)
                                <div class="border-2 rounded-lg p-4 transition-all
                                    {{ $isOccupied ? 'bg-green-100 border-green-500' : 'bg-gray-100 border-gray-300' }}
                                ">
                                    <!-- Table Number -->
                                    <div class="flex items-center justify-between mb-3">
                                        <h4 class="text-lg font-bold text-gray-800">Meja {{ $tableNumber }}</h4>
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                                            {{ $isOccupied ? 'bg-green-500 text-white' : 'bg-gray-400 text-white' }}
                                        ">
                                            {{ $isOccupied ? 'Terisi' : 'Kosong' }}
                                        </span>
                                    </div>

                                    <!-- Order Info (if occupied) -->
                                    @if($isOccupied && $table->order)
                                        <div class="text-sm text-gray-600 space-y-1">
                                            <p><strong>Order ID:</strong> #{{ $table->order->id }}</p>
                                            <p><strong>Customer:</strong> {{ $table->order->user->name ?? 'N/A' }}</p>
                                            <p><strong>Total:</strong> Rp {{ number_format($table->order->total_price, 0, ',', '.') }}</p>
                                            <p><strong>Status:</strong>
                                                <span class="px-2 py-1 rounded text-xs
                                                    {{ $table->order->status === 'pending' ? 'bg-yellow-200 text-yellow-800' : '' }}
                                                    {{ $table->order->status === 'paid' ? 'bg-blue-200 text-blue-800' : '' }}
                                                    {{ $table->order->status === 'done' ? 'bg-green-200 text-green-800' : '' }}
                                                ">
                                                    {{ ucfirst($table->order->status) }}
                                                </span>
                                            </p>

                                            <!-- Link to Order Detail -->
                                            <a href="{{ url('/admin/orders/' . $table->order->id) }}"
                                               class="inline-block mt-2 text-blue-600 hover:text-blue-800 text-xs font-semibold">
                                                Lihat Detail →
                                            </a>
                                        </div>
                                    @else
                                        <p class="text-sm text-gray-500 italic">Tidak ada customer</p>
                                    @endif
                                </div>
                            @else
                                <div class="border-2 border-red-300 rounded-lg p-4 bg-red-50">
                                    <p class="text-red-600 font-semibold">Error: Data meja tidak ditemukan</p>
                                </div>
                            @endif
                        @endfor
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>
@endsection
