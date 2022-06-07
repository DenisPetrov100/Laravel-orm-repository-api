<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Shop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $productsSet1 = Product::factory(10)->create();
        $productsSet2 = Product::factory(10)->create();
        $productsSet3 = Product::factory(10)->create();
        $productsSet4 = Product::factory(10)->create();
        $shop1 = Shop::factory(1)->create();
        $shop2 = Shop::factory(1)->create();
        $shop3 = Shop::factory(1)->create();
        $shop4 = Shop::factory(1)->create();

        foreach($productsSet1 as $product){
            $price = mt_rand(5, 15);
            $product->shops()->attach($shop1, ["price" => $price]);
            $product->shops()->attach($shop2, ["price" => $price + 1]);
            // $product->shops()->attach($shop3, ["price" => $price + 3]);
            $product->shops()->attach($shop4, ["price" => $price + 5]);
        }

        foreach($productsSet2 as $product){
            $price = mt_rand(15, 25);
            //$product->shops()->attach($shop1, ["price" => $price]);
            $product->shops()->attach($shop2, ["price" => $price + 3]);
            $product->shops()->attach($shop3, ["price" => $price + 1]);
            $product->shops()->attach($shop4, ["price" => $price + 5]);
        }
        foreach($productsSet3 as $product){
            $price = mt_rand(1, 5);
            //$product->shops()->attach($shop1, ["price" => $price]);
            $product->shops()->attach($shop2, ["price" => $price + 1]);
            $product->shops()->attach($shop3, ["price" => $price + 3]);
            $product->shops()->attach($shop4, ["price" => $price + 5]);
        }
        foreach($productsSet4 as $product){
            $price = mt_rand(18, 30);
            $product->shops()->attach($shop1, ["price" => $price]);
            $product->shops()->attach($shop2, ["price" => $price + 1]);
            // $product->shops()->attach($shop3, ["price" => $price + 3]);
            $product->shops()->attach($shop4, ["price" => $price - 2]);
        }
    }
}
