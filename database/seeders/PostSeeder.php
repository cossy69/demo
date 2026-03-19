<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryIds = DB::table('categories')->pluck('id')->toArray();
        $postSeed = [];
        for($i = 0; $i<10; $i++) {
            $postSeed[] = [
                'title'=>fake()->sentence(),
                'content'=>fake()->paragraph(),
                'image'=>fake()->imageUrl(),
                'category_id'=> $categoryIds[array_rand($categoryIds)],
                'status'=>fake()->numberBetween(0, 1),
            ];
        }
        DB::table('posts')->insert($postSeed);
    }
}