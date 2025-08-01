<?php

namespace Database\Seeders;

use App\Models\CategoriesModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [];
        $faker = Faker::create();
        $current_time = now();
        for ($i = 0; $i < 3000; $i++) {
            $categories[] = [
                'name' => $faker->word(),
                'created_at' => $current_time,
                'updated_at' => $current_time
            ];
        }

        foreach (array_chunk($categories, 1000) as $chunk) {
            DB::table('categories')->insert($chunk);
        }
    }
}
