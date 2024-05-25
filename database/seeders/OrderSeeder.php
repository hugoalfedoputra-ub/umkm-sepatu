<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Product;
use Faker\Factory as Faker;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        $users = User::all();
        $products = Product::all();

        foreach ($users as $user) {
            for ($i = 0; $i < 2; $i++) {
                $date = $faker->dateTimeBetween('-1 years', 'now');
                $order = Order::create([
                    'user_id' => $user->id,
                    'session_token' => $faker->uuid,
                    'status' => $faker->randomElement(['pending', 'diproses', 'dalam perjalanan', 'selesai', 'canceled']),
                    'payment_method' => $faker->randomElement(['cash_on_delivery', 'credit_card', 'bank_transfer']),
                    'total_price' => $faker->numberBetween(100000, 1000000),
                    'address' => $faker->address,
                    'created_at' => $date,
                    'updated_at' => $date
                ]);

                for ($j = 0; $j < $faker->numberBetween(1, 5); $j++) {
                    $product = $products->random();
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'name' => $product->name,
                        'image' => $product->image,
                        'price' => $product->price,
                        'quantity' => $faker->numberBetween(1, 3),
                        'size' => $faker->randomElement(['37', '38', '39', '40', '41', '42', '43', '44']),
                        'color' => $faker->randomElement(['black', 'red', 'white']),
                        'created_at' => $date,
                        'updated_at' => $date
                    ]);
                }
            }
        }
    }
}
