<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        return response()->json(
            Product::create($data),
            201
        );
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $product = Product::findOrFail($id);
        $product->update($data);

        return response()->json($product);
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Product deleted'
        ]);
    }
}
