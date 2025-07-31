<?php

namespace Database\Seeders;

use App\Models\BooksModel;
use App\Models\RatingsModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RatingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ratings = [];
        $faker = Faker::create();
        $get_bookIds = BooksModel::pluck('id')->toArray();

        for ($i = 0; $i < 10000; $i++) {
            $ratings[] = [
                'book_id' => $faker->randomElement($get_bookIds),
                'rating' => $faker->numberBetween(1, 10),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        foreach (array_chunk($ratings, 5000) as $chunk) {
            RatingsModel::insert($chunk);
        }
    }
}
