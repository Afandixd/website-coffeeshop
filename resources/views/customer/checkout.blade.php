<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Struk Pesanan</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            padding: 40px;
        }

        .box {
            max-width: 400px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
        }

        .btn {
            padding: 8px 15px;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }

        .print {
            background: #c79e2d;
        }

        .close {
            background: red;
        }
    </style>
</head>
<body>

<div class="box">
    <h3>Struk Pesanan</h3>

    @php $total = 0; @endphp

    @foreach(session('cart') as $item)
        <p>
            {{ $item['name'] }} x{{ $item['quantity'] }}
            Rp {{ number_format($item['price'] * $item['quantity'],0,',','.') }}
        </p>
        @php $total += $item['price'] * $item['quantity']; @endphp
    @endforeach

    <hr>

    <p><strong>Total Harga: Rp {{ number_format($total,0,',','.') }}</strong></p>

    <form method="GET" action="{{ url('/thank-you') }}">
        <button class="btn print">Cetak Struk</button>
        <button class="btn close">Tutup</button>
    </form>
</div>

</body>
</html>
