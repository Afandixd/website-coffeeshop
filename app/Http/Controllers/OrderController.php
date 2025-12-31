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
    $orders = Order::with('orderItems.product', 'user')->get();
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

public function checkout()
{
    $products = Product::all();
    return view('checkout', compact('products'));
}

public function store(Request $request)
{
    $items = collect($request->items)
        ->filter(fn ($item) => $item['quantity'] > 0);

    if ($items->isEmpty()) {
        return back();
    }

    $order = Order::create([
        'user_id' => Auth::id(),
        'status' => 'pending',
        'total_price' => 0,
    ]);

    $total = 0;

    foreach ($items as $item) {
        $product = Product::findOrFail($item['product_id']);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $item['quantity'],
            'price' => $product->price,
        ]);

        $total += $product->price * $item['quantity'];
    }

    $order->update([
        'total_price' => $total,
    ]);

    return redirect('/dashboard');
}


}
