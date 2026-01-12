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
            ['name'=>'Americano','category'=>'coffee','price'=>15000,'stock'=>50],
            ['name'=>'Cappuccino','category'=>'coffee','price'=>18000,'stock'=>50],
            ['name'=>'Cold Brew','category'=>'coffee','price'=>15000,'stock'=>50],
            ['name'=>'Espresso','category'=>'coffee','price'=>10000,'stock'=>50],
            ['name'=>'Mocha Latte','category'=>'coffee','price'=>28000,'stock'=>50],
            ['name'=>'V60','category'=>'coffee','price'=>22000,'stock'=>50],

            // Non Coffee
            ['name'=>'Avocado Yogurt Smoothies','category'=>'non_coffee','price'=>30000,'stock'=>50],
            ['name'=>'Lime Squash','category'=>'non_coffee','price'=>15000,'stock'=>50],
            ['name'=>'Lychee Fresh Sparkle','category'=>'non_coffee','price'=>30000,'stock'=>50],
            ['name'=>'Matcha Float','category'=>'non_coffee','price'=>15000,'stock'=>50],
            ['name'=>'Milk Tea','category'=>'non_coffee','price'=>18000,'stock'=>50],
            ['name'=>'Vanilla Tea','category'=>'non_coffee','price'=>28000,'stock'=>50],

            // Foods
            ['name'=>'Burger','category'=>'foods','price'=>15000,'stock'=>50],
            ['name'=>'Chicken Nugget','category'=>'foods','price'=>22000,'stock'=>50],
            ['name'=>'Chicken Wings','category'=>'foods','price'=>28000,'stock'=>50],
            ['name'=>'Fries','category'=>'foods','price'=>15000,'stock'=>50],
            ['name'=>'Noodles','category'=>'foods','price'=>18000,'stock'=>50],
            ['name'=>'Sosis','category'=>'foods','price'=>30000,'stock'=>50],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
