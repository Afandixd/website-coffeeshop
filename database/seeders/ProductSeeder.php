<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Coffee
            ['name' => 'Americano', 'price' => 15000, 'stock' => 50, 'category' => 'coffee', 'image' => 'americano.png'],
            ['name' => 'Cappuccino', 'price' => 18000, 'stock' => 50, 'category' => 'coffee', 'image' => 'cappuccino.png'],
            ['name' => 'Cold Brew', 'price' => 15000, 'stock' => 50, 'category' => 'coffee', 'image' => 'coldbrew.png'],
            ['name' => 'Espresso', 'price' => 10000, 'stock' => 50, 'category' => 'coffee', 'image' => 'espresso.png'],
            ['name' => 'Mocha Latte', 'price' => 28000, 'stock' => 50, 'category' => 'coffee', 'image' => 'mocha-latte.png'],
            ['name' => 'V60', 'price' => 22000, 'stock' => 50, 'category' => 'coffee', 'image' => 'v60.png'],

            // Non-Coffee
            ['name' => 'Avocado Yogurt Smoothies', 'price' => 30000, 'stock' => 50, 'category' => 'non-coffee', 'image' => 'avocado-yogurt-smoothies.png'],
            ['name' => 'Lime Squash', 'price' => 15000, 'stock' => 50, 'category' => 'non-coffee', 'image' => 'lime-squash.png'],
            ['name' => 'Lychee Fresh Sparkle', 'price' => 30000, 'stock' => 50, 'category' => 'non-coffee', 'image' => 'lychee-fresh-sparkle.png'],
            ['name' => 'Matcha Float', 'price' => 15000, 'stock' => 50, 'category' => 'non-coffee', 'image' => 'matcha-float.png'],
            ['name' => 'Milk Tea', 'price' => 18000, 'stock' => 50, 'category' => 'non-coffee', 'image' => 'milk-tea.png'],
            ['name' => 'Vanilla Tea', 'price' => 28000, 'stock' => 50, 'category' => 'non-coffee', 'image' => 'vanilla-tea.png'],

            // Food
            ['name' => 'Burger', 'price' => 15000, 'stock' => 50, 'category' => 'food', 'image' => 'burger.png'],
            ['name' => 'Chicken Nugget', 'price' => 22000, 'stock' => 50, 'category' => 'food', 'image' => 'chicken-nugget.png'],
            ['name' => 'Chicken Wings', 'price' => 28000, 'stock' => 50, 'category' => 'food', 'image' => 'chicken-wings.png'],
            ['name' => 'Fries', 'price' => 15000, 'stock' => 50, 'category' => 'food', 'image' => 'fries.png'],
            ['name' => 'Noodles', 'price' => 18000, 'stock' => 50, 'category' => 'food', 'image' => 'noodles.png'],
            ['name' => 'Sosis', 'price' => 30000, 'stock' => 50, 'category' => 'food', 'image' => 'sosis.png'],
        ];

        foreach ($products as $data) {
            Product::updateOrCreate(
                ['name' => $data['name']],
                $data
            );
        }
    }
}
