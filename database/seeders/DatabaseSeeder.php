<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Create Admin manually
        // User::create([
        //     'name' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => bcrypt('admin@123'),
        //     'usertype' => 1, // Admin
        // ]);


            // Create 10 customers
            User::factory(10)->create();

            // // Create 5 categories
            Category::factory(5)->create();
    
            // Create 50 products
            // Product::factory(50)->create();
            Product::factory(20)
            ->withCategories()  // Assign categories using the factory's method
            ->withImages()
            ->create();

    }
}
