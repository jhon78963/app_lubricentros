<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $product = new Product();
        $product->name = "Revisión Técnica";
        $product->category_id = 1;
        $product->stock = 0;
        $product->purchase_price = 150;
        $product->sale_price = 150;
        $product->code_bar = "0000000000000";
        $product->save();

        $product = new Product();
        $product->name = "CASTROL MAGNATEC 10W30 - Aceite Semi Sintético";
        $product->category_id = 2;
        $product->stock = 50;
        $product->purchase_price = 130;
        $product->sale_price = 180.75;
        $product->code_bar = "400177118364";
        $product->save();

    }
}
