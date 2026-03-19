<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryIds = DB::table('categories')->pluck('id')->toArray();
        $productSeed = [];
        for($i = 0; $i<10; $i++) {
            $productSeed[] = [
                'name'=>fake()->name(),
                'price'=>fake()->numberBetween(1000, 100000),
                'quantity'=>fake()->numberBetween(1, 100),
                'image'=>fake()->imageUrl(),
                'category_id'=> $categoryIds[array_rand($categoryIds)],
                'status'=>fake()->numberBetween(0, 1),
            ];
        }
        DB::table('products')->insert($productSeed);
    }
}