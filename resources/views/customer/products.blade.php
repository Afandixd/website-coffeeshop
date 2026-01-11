<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laman Utama - Coffee Shop</title>
    <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
    @vite(['resources/css/app.css'])
    <style>
        /* CSS Global */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #000;
            color: white;
            position: relative;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #C8A882 0%, #8B6F47 100%);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            filter: blur(5px) brightness(1.2);
            z-index: -1;
        }

        /* Header */
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: rgba(207, 180, 26, 0.9);
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .logo {
            height: 40px;
            width: 40px;
        }

        .header-title {
            flex: 1;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }

        header a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        /* Search Bar */
        .search-bar {
            margin: 100px auto 20px;
            text-align: center;
        }

        .search-bar input {
            width: 70%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px 0 0 5px;
            outline: none;
        }

        .search-bar button {
            padding: 10px 15px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
        }

        /* Section */
        .section {
            margin: 30px 20px;
        }

        .section h2 {
            font-size: 28px;
            margin-bottom: 15px;
        }

        .catalog-container {
            display: flex;
            overflow-x: auto;
            gap: 20px;
            padding-bottom: 10px;
        }

        .menu-item {
            flex: 0 0 auto;
            width: 200px;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 10px;
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .menu-item img {
            width: 100%;
            height: 120px;
            border-radius: 10px;
            object-fit: cover;
        }

        .name {
            font-weight: bold;
            margin: 10px 0;
            color: #e9e520;
        }

        .price {
            color: #ffffff;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .btn {
            padding: 8px 15px;
            background-color: #c79e2d;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn:hover {
            background-color: #a8831f;
        }

        .btn-order {
            position: fixed;
            bottom: 40px;
            right: 40px;
            background-color: #28a745;
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 50px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            z-index: 1050;
        }

        .btn-order:hover {
            background-color: #218838;
        }

        /* Footer */
        footer {
            background-color: #ffffff;
            color: #333;
            padding: 20px 0;
            text-align: center;
            margin-top: 50px;
        }

        .footer-links a {
            color: #000;
            text-decoration: none;
            margin: 0 15px;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }

        /* Success Alert */
        .alert-success {
            position: fixed;
            top: 80px;
            right: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            z-index: 2000;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from { transform: translateX(400px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo-container">
            <svg class="logo" viewBox="0 0 100 100">
                <circle cx="50" cy="50" r="45" fill="none" stroke="#ffffff" stroke-width="3"/>
                <path d="M 30 60 Q 50 40 70 60" fill="none" stroke="#ffffff" stroke-width="3"/>
                <circle cx="35" cy="45" r="3" fill="#ffffff"/>
                <circle cx="65" cy="45" r="3" fill="#ffffff"/>
            </svg>
        </div>
        <span class="header-title">Coffee Shop</span>
        <div>
            <a href="{{ url('/my-orders') }}">My Orders</a> |
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" style="background: none; border: none; color: white; cursor: pointer; font-weight: bold;">Logout</button>
            </form>
        </div>
    </header>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(() => {
                document.querySelector('.alert-success').style.display = 'none';
            }, 3000);
        </script>
    @endif

    <!-- Search Bar -->
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Cari menu..." onkeyup="filterMenu()">
        <button onclick="filterMenu()">Cari</button>
    </div>

    <!-- Coffee Section -->
    <div class="section">
        <h2>Coffee</h2>
        <div class="catalog-container">
            @foreach($products->where('category', 'coffee') as $product)
            <div class="menu-item" data-name="{{ strtolower($product->name) }}">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                @else
                    <img src="https://via.placeholder.com/200x120?text=Coffee" alt="{{ $product->name }}">
                @endif
                <p class="name">{{ $product->name }}</p>
                <p class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <form method="POST" action="{{ url('/cart/add') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn">Add</button>
                </form>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Non-Coffee Section -->
    <div class="section">
        <h2>Non-Coffee</h2>
        <div class="catalog-container">
            @foreach($products->where('category', 'non-coffee') as $product)
            <div class="menu-item" data-name="{{ strtolower($product->name) }}">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                @else
                    <img src="https://via.placeholder.com/200x120?text=Drink" alt="{{ $product->name }}">
                @endif
                <p class="name">{{ $product->name }}</p>
                <p class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <form method="POST" action="{{ url('/cart/add') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn">Add</button>
                </form>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Food Section -->
    <div class="section">
        <h2>Food</h2>
        <div class="catalog-container">
            @foreach($products->where('category', 'food') as $product)
            <div class="menu-item" data-name="{{ strtolower($product->name) }}">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                @else
                    <img src="https://via.placeholder.com/200x120?text=Food" alt="{{ $product->name }}">
                @endif
                <p class="name">{{ $product->name }}</p>
                <p class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <form method="POST" action="{{ url('/cart/add') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn">Add</button>
                </form>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Order Button -->
    <a href="{{ url('/checkout') }}" class="btn-order">Pesan</a>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <p>&copy; 2025 Coffee Shop. All rights reserved.</p>
            <div class="footer-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Contact</a>
            </div>
        </div>
    </footer>

    <script>
        function filterMenu() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const items = document.querySelectorAll('.menu-item');

            items.forEach(item => {
                const name = item.getAttribute('data-name');
                if (name.includes(input)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>
