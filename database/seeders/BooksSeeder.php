<?php

namespace Database\Seeders;

use App\Models\AuthorsModel;
use App\Models\BooksModel;
use App\Models\CategoriesModel;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $get_authorIds = AuthorsModel::pluck('id')->toArray();
        $get_categoryIds = CategoriesModel::pluck('id')->toArray();

        $books = [];
        $faker = Faker::create();
        for ($i = 0; $i < 100; $i++) {
            $books[] = [
                'name' => $faker->word(),
                'author_id' => $faker->randomElement($get_authorIds),
                'category_id' => $faker->randomElement($get_categoryIds),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        foreach (array_chunk($books, 2000) as $chunk) {
            BooksModel::insert($chunk);
        }
    }
}
