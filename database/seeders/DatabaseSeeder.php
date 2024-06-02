<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'miaw',
            'email' => 'miaw@miaw.com',
            'password' => bcrypt('miawmiaw'),
        ]);
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('adminpassword'),
            'userrole' => 'admin',
        ]);

        User::factory(50)->create();

        $this->call(ProductSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(ReviewSeeder::class);
    }
}
