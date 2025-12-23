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
        return response()->json(
            Order::with('orderItems.product')->get()
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'pending',
            'total_price' => 0,
        ]);

        $total = 0;

        foreach ($data['items'] as $item) {
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

        return response()->json($order, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'status' => 'required|string',
        ]);

        $order = Order::findOrFail($id);
        $order->update($data);

        return response()->json($order);
    }
}
