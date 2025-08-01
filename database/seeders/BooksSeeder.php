<?php

namespace Database\Seeders;

use App\Models\AuthorsModel;
use App\Models\BooksModel;
use App\Models\CategoriesModel;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

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
        $current_time = now();
        for ($i = 0; $i < 100000; $i++) {
            $books[] = [
                'name' => $faker->word(),
                'author_id' => $faker->randomElement($get_authorIds),
                'category_id' => $faker->randomElement($get_categoryIds),
                'created_at' => $current_time,
                'updated_at' => $current_time
            ];
        }

        foreach (array_chunk($books, 10000) as $chunk) {
            DB::table('books')->insert($chunk);
        }
    }
}
