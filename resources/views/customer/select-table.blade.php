<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Meja - Coffee Shop</title>
    @vite(['resources/css/app.css'])
    <style>
        /* Custom radio button styling */
        input[type="radio"]:checked + .table-box {
            background-color: #3B82F6 !important;
            color: white !important;
            border: 3px solid #60A5FA;
            transform: scale(1.05);
        }
    </style>
</head>
<body class="bg-gray-50">

    <!-- Header -->
    <div class="bg-white border-b shadow-sm">
        <div class="max-w-4xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <span class="text-green-600 text-2xl">☘️</span>
                <h1 class="text-xl font-bold text-gray-800" style="font-family: cursive;">Coffee Shop</h1>
            </div>
            <a href="{{ url('/checkout') }}" class="text-green-600 hover:text-green-700">
                ← Back to Cart
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center py-12 px-4">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-2xl">

            <h2 class="text-2xl font-bold text-center mb-6">Pemilihan Tempat Duduk</h2>

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Legend -->
            <div class="flex justify-center gap-8 mb-6">
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-gray-400 rounded"></div>
                    <span class="text-sm text-gray-600">Kosong</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-green-500 rounded"></div>
                    <span class="text-sm text-gray-600">Terisi</span>
                </div>
            </div>

            <!-- Table Selection Form -->
            <form method="POST" action="{{ url('/confirm-order') }}" id="tableForm">
                @csrf

                <!-- Tables Grid (3x4 = 12 meja) -->
                <div class="space-y-6 mb-6">
                    @for($row = 1; $row <= 3; $row++)
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700 mb-3">
                                Meja {{ ($row - 1) * 4 + 1 }} - {{ $row * 4 }}
                            </h3>
                            <div class="grid grid-cols-4 gap-4">
                                @for($col = 1; $col <= 4; $col++)
                                    @php
                                        $tableNumber = ($row - 1) * 4 + $col;
                                        $table = $tables->firstWhere('table_number', $tableNumber);
                                        $isOccupied = $table && $table->status === 'occupied';
                                    @endphp

                                    @if($table)
                                        <label class="{{ $isOccupied ? 'cursor-not-allowed' : 'cursor-pointer' }}">
                                            <input
                                                type="radio"
                                                name="table_id"
                                                value="{{ $table->id }}"
                                                {{ $isOccupied ? 'disabled' : '' }}
                                                required
                                                class="hidden"
                                            >
                                            <div class="table-box w-full h-16 rounded-lg flex items-center justify-center font-semibold transition-all duration-200
                                                {{ $isOccupied ? 'bg-green-500 text-white' : 'bg-gray-400 text-black hover:bg-gray-500' }}
                                            ">
                                                Meja {{ $tableNumber }}
                                            </div>
                                        </label>
                                    @else
                                        <div class="w-full h-16 rounded-lg flex items-center justify-center bg-red-300 text-white font-semibold">
                                            Error
                                        </div>
                                    @endif
                                @endfor
                            </div>
                        </div>
                    @endfor
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full bg-green-500 hover:bg-green-600 text-black font-bold py-3 rounded-lg transition-all duration-300 shadow-md"
                >
                    Submit
                </button>
            </form>
        </div>
    </div>

</body>
</html>
