<?php

namespace Database\Seeders;

use App\Models\CategoriesModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [];
        $faker = Faker::create();
        for ($i = 0; $i < 150; $i++) {
            $categories[] = [
                'name' => $faker->word(),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        foreach (array_chunk($categories, 1000) as $chunk) {
            CategoriesModel::insert($chunk);
        }
    }
}
