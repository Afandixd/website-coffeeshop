<nav class="bg-gradient-to-r from-orange-600 to-orange-500 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo & Brand -->
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold text-black">☕ CoffeeShop</span>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden md:flex items-center space-x-1">
                @auth
                    <!-- Customer Menu -->
                    @if(auth()->user()->role !== 'admin')
                        <a href="{{ url('/dashboard') }}"
                           class="text-black hover:bg-orange-700 px-4 py-2 rounded-lg transition {{ request()->is('dashboard') ? 'bg-orange-700' : '' }}">
                            🏠 Home
                        </a>
                        <a href="{{ url('/products') }}"
                           class="text-black hover:bg-orange-700 px-4 py-2 rounded-lg transition {{ request()->is('products') ? 'bg-orange-700' : '' }}">
                            ☕ Menu
                        </a>
                        <a href="{{ url('/my-orders') }}"
                           class="text-black hover:bg-orange-700 px-4 py-2 rounded-lg transition {{ request()->is('my-orders') ? 'bg-orange-700' : '' }}">
                            📦 My Orders
                        </a>
                        <a href="{{ url('/checkout') }}"
                           class="text-black hover:bg-orange-700 px-4 py-2 rounded-lg transition {{ request()->is('checkout') ? 'bg-orange-700' : '' }}">
                            🛒 Checkout
                        </a>
                    @endif

                    <!-- Admin Menu -->
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ url('/admin/dashboard') }}"
                           class="text-black hover:bg-orange-700 px-4 py-2 rounded-lg transition {{ request()->is('admin/dashboard') ? 'bg-orange-700' : '' }}">
                            📊 Dashboard
                        </a>
                        <a href="{{ url('/admin/products') }}"
                           class="text-black hover:bg-orange-700 px-4 py-2 rounded-lg transition {{ request()->is('admin/products*') ? 'bg-orange-700' : '' }}">
                            📦 Produk
                        </a>
                        <a href="{{ url('/admin/orders') }}"
                           class="text-black hover:bg-orange-700 px-4 py-2 rounded-lg transition {{ request()->is('admin/orders*') ? 'bg-orange-700' : '' }}">
                            📋 Orders
                        </a>
                    @endif
                @endauth
            </div>

            <!-- User Menu -->
            <div class="flex items-center gap-4">
                @auth
                    <!-- User Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2 text-white hover:bg-orange-700 px-4 py-2 rounded-lg transition">
                            <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center">
                                <span class="text-orange-600 font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
                            <span class="hidden md:block">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-2 z-50"
                             style="display: none;">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                                👤 Profile
                            </a>

                            @if(auth()->user()->role === 'admin')
                                <a href="{{ url('/products') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">
                                    🏪 View as Customer
                                </a>
                            @endif

                            <hr class="my-2">

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">
                                    🚪 Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-black hover:bg-orange-700 px-4 py-2 rounded-lg transition">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-black text-orange-600 hover:bg-gray-100 px-4 py-2 rounded-lg font-semibold transition">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="md:hidden" x-data="{ open: false }">
        <button @click="open = !open" class="w-full text-black px-4 py-2 text-left hover:bg-orange-700">
            ☰ Menu
        </button>

        <div x-show="open" class="bg-orange-700 px-4 py-2 space-y-1" style="display: none;">
            @auth
                @if(auth()->user()->role !== 'admin')
                    <a href="{{ url('/dashboard') }}" class="block text-black py-2">🏠 Home</a>
                    <a href="{{ url('/products') }}" class="block text-black py-2">☕ Menu</a>
                    <a href="{{ url('/my-orders') }}" class="block text-black py-2">📦 My Orders</a>
                    <a href="{{ url('/checkout') }}" class="block text-black py-2">🛒 Checkout</a>
                @else
                    <a href="{{ url('/admin/dashboard') }}" class="block text-black py-2">📊 Dashboard</a>
                    <a href="{{ url('/admin/products') }}" class="block text-black py-2">📦 Produk</a>
                    <a href="{{ url('/admin/orders') }}" class="block text-black py-2">📋 Orders</a>
                @endif
            @endauth
        </div>
    </div>
</nav>

<!-- Alpine.js for dropdown (tambahkan di layouts/app.blade.php sebelum </body>) -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
