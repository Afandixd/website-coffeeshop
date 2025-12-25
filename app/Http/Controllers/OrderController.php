<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
public function index()
{
    $orders = Order::with('user')->latest()->get();
    return view('admin.orders.index', compact('orders'));
}

public function show($id)
{
    $order = Order::with('orderItems.product', 'user')->findOrFail($id);
    return view('admin.orders.show', compact('order'));
}

public function update(Request $request, $id)
{
    $data = $request->validate([
        'status' => 'required|string',
    ]);

    $order = Order::findOrFail($id);
    $order->update($data);

    return redirect('/admin/orders');
}

}
