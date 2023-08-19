<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        for($i=0;$i<20;$i++)
        {
            $product = Product::create([
                "name" => "Test Product" . $i,
                "slug" => "test-product" .$i,
                "description" => "This is a test product". $i,
                "price" => 100.99,
            ]);
        }
    }
}
