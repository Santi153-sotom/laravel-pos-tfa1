<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Rice, 5 kg', 'price' => 350.00, 'stock_quantity' => 20],
            ['name' => 'Cooking Oil, 1 L', 'price' => 120.00, 'stock_quantity' => 30],
            ['name' => 'Sugar, 1 kg', 'price' => 85.00, 'stock_quantity' => 25],
            ['name' => 'Canned Sardines', 'price' => 28.50, 'stock_quantity' => 50],
            ['name' => 'Bottled Water, 1 L', 'price' => 25.00, 'stock_quantity' => 40],
        ];

        foreach ($products as $product) {
            $alreadyExists = DB::table('products')
                ->where('name', $product['name'])
                ->exists();

            if (! $alreadyExists) {
                DB::table('products')->insert([
                    ...$product,
                    'image' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
