<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
public function add(Request $request)
{
    $product = Product::findOrFail($request->product_id);

    $order = Order::firstOrCreate(
        [
            'user_id' => Auth::id(),
            'status' => 'pending'
        ],
        [
            'total_price' => 0
        ]
    );

    OrderItem::create([
        'order_id'  => $order->id,
        'product_id'=> $product->id,
        'price'     => $product->price,
        'quantity'  => 1
    ]);

    return response()->json(['success' => true]);
}

}
