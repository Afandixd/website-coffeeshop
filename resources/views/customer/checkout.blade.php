<!DOCTYPE html>
<html>
<head>
    <title>Struk Pesanan</title>
    <style>
        body {
            font-family: Arial;
            background: #111;
            color: white;
            padding: 30px;
        }

        .box {
            max-width: 400px;
            margin: auto;
            background: #222;
            padding: 20px;
            border-radius: 10px;
        }

        h2 {
            text-align: center;
        }

        .item {
            margin-bottom: 10px;
        }

        .total {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }

        .btn {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background: green;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Struk Pesanan</h2>

    @foreach($cart as $item)
        <div class="item">
            {{ $item['name'] }} x {{ $item['quantity'] }}
            Rp {{ number_format($item['price'] * $item['quantity'],0,',','.') }}
        </div>
    @endforeach

    <div class="total">
        Total: Rp {{ number_format($total,0,',','.') }}
    </div>

    <button class="btn">Bayar</button>
</div>

</body>
</html>
