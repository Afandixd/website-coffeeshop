<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalProducts' => Product::count(),
            'totalOrders'   => Order::count(),
            'pendingOrders' => Order::where('status', 'pending')->count(),
            'doneOrders'    => Order::where('status', 'done')->count(),
            'products'      => Product::all(), // ✅ ini wajib agar tabel produk muncul
        ]);
    }
}
