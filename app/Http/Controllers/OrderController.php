<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['orderItems.product', 'user'])
                       ->latest()
                       ->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['orderItems.product', 'user'])
                      ->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,paid,done',
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'status' => $data['status'],
        ]);

        return redirect('/admin/orders')->with('success', 'Status order berhasil diupdate');
    }

    public function checkout()
    {
        $products = Product::where('stock', '>', 0)->get();
        return view('checkout', compact('products'));
    }

    public function store(Request $request)
    {
        // Validasi format items
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:0',
        ]);

        try {
            DB::beginTransaction();

            // Filter item yang quantity > 0
            $validItems = [];
            foreach ($request->items as $productId => $item) {
                if (isset($item['quantity']) && $item['quantity'] > 0) {
                    $validItems[$productId] = $item;
                }
            }

            // Cek apakah ada item yang dipilih
            if (empty($validItems)) {
                return redirect()->back()
                    ->with('error', 'Pilih minimal 1 produk dengan quantity > 0')
                    ->withInput();
            }

            // Cek stok semua produk dulu sebelum proses
            $stockErrors = [];
            foreach ($validItems as $productId => $item) {
                $product = Product::find($item['product_id']);

                if (!$product) {
                    $stockErrors[] = "Produk tidak ditemukan";
                    continue;
                }

                if ($product->stock < $item['quantity']) {
                    $stockErrors[] = "Stok {$product->name} tidak cukup (tersisa: {$product->stock}, diminta: {$item['quantity']})";
                }
            }

            if (!empty($stockErrors)) {
                return redirect()->back()
                    ->with('error', implode(' | ', $stockErrors))
                    ->withInput();
            }

            // Buat order
            $total = 0;
            $order = Order::create([
                'user_id' => Auth::id(),
                'status' => 'pending',
                'total_price' => 0,
            ]);

            // Proses setiap item
            foreach ($validItems as $productId => $item) {
                $product = Product::findOrFail($item['product_id']);

                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $product->id,
                    'quantity'   => $item['quantity'],
                    'price'      => $product->price,
                ]);

                // KURANGI STOK
                $product->stock -= $item['quantity'];
                $product->save();

                $total += $product->price * $item['quantity'];
            }

            // Update total price
            $order->update(['total_price' => $total]);

            DB::commit();

            return redirect('/my-orders')->with('success', 'Order berhasil dibuat! Total: Rp ' . number_format($total, 0, ',', '.'));

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->with('error', 'Checkout gagal: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function myOrders()
    {
        $orders = Order::with('orderItems.product')
                       ->where('user_id', Auth::id())
                       ->latest()
                       ->get();

        return view('customer.orders', compact('orders'));
    }
}
