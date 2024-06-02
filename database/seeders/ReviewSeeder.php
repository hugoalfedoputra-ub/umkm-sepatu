<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        $productIds = Product::pluck('id')->toArray();
        $customerName = User::pluck('name')->toArray();

        foreach (range(1, 1000) as $index) {
            Review::create([
                'product_id' => $faker->randomElement($productIds), // asumsikan ada 10 produk
                'customer_name' => $faker->randomElement($customerName),
                'rating' => $faker->numberBetween(1, 5),
                'comment' => $faker->sentence
            ]);
        }
    }
}
