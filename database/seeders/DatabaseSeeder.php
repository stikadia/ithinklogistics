<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $categories = [
            ['id' => 1, 'name' => 'Electronics', 'parent_category_id' => null],
            ['id' => 2, 'name' => 'Mobiles', 'parent_category_id' => 1],
            ['id' => 3, 'name' => 'Laptops', 'parent_category_id' => 1],
            ['id' => 4, 'name' => 'Cameras', 'parent_category_id' => 1],

            ['id' => 5, 'name' => 'Fashion', 'parent_category_id' => null],
            ['id' => 6, 'name' => 'Men\'s Clothing', 'parent_category_id' => 5],
            ['id' => 7, 'name' => 'Women\'s Clothing', 'parent_category_id' => 5],
            ['id' => 8, 'name' => 'Footwear', 'parent_category_id' => 5],

            ['id' => 9, 'name' => 'Home & Furniture', 'parent_category_id' => null],
            ['id' => 10, 'name' => 'Furniture', 'parent_category_id' => 9],
            ['id' => 11, 'name' => 'Home Decor', 'parent_category_id' => 9],

            ['id' => 12, 'name' => 'Beauty & Health', 'parent_category_id' => null],
            ['id' => 13, 'name' => 'Skincare', 'parent_category_id' => 12],
            ['id' => 14, 'name' => 'Haircare', 'parent_category_id' => 12],

            ['id' => 15, 'name' => 'Sports & Fitness', 'parent_category_id' => null],
            ['id' => 16, 'name' => 'Gym Equipment', 'parent_category_id' => 15],
            ['id' => 17, 'name' => 'Outdoor Sports', 'parent_category_id' => 15],
        ];

        foreach ($categories as $category) {
            Category::create($category);

            for ($i = 1; $i <= 5; $i++) {
                $catname = $category["name"];
                $data = [
                    "name" =>  $catname . ' Product ' . $i,
                    "description" => 'This is a sample description for ' . strtolower($catname) . ' product.',
                    'sku' => strtoupper(Str::random(10)),
                    'price' => rand(100, 10000),
                    'category_id' => $category["id"],
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ];

                Product::create($data);
            }
        }
    }
}
