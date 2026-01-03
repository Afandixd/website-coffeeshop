<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
public function index()
{
    $user = Auth::user();

    return view('dashboard', [
        'user'          => $user,
        'totalProducts' => \App\Models\Product::count(),
        'totalOrders'   => \App\Models\Order::count(),
        'pendingOrders' => \App\Models\Order::where('status', 'pending')->count(),
        'doneOrders'    => \App\Models\Order::where('status', 'done')->count(),
    ]);
}
}
