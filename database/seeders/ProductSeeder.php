<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductVariant;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        $sizes = ['37', '38', '39', '40', '41', '42', '43', '44'];
        $colors = ['black', 'red', 'white'];
        $imagesPath = public_path('storage/images');
        $images = array_diff(scandir($imagesPath), array('.', '..'));

        for ($i = 0; $i < 50; $i++) {
            $product = Product::create([
                'name' => $faker->word,
                'description' => $faker->sentence(500),
                'price' => $faker->numberBetween(100000, 500000),
                'image' => 'storage/images/' . $faker->randomElement($images),
            ]);

            foreach ($sizes as $size) {
                foreach ($colors as $color) {
                    ProductVariant::create([
                        'product_id' => $product->id,
                        'size' => $size,
                        'color' => $color,
                        'stock' => $faker->numberBetween(1, 20),
                    ]);
                }
            }
        }
    }
}
