<?php

namespace Database\Seeders;

use App\Models\BooksModel;
use App\Models\RatingsModel;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class RatingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ratings = [];
        $faker = Faker::create();
        $get_bookIds = BooksModel::select('id')->orderBy(DB::raw('RAND()'))->limit(100)->pluck('id')->toArray();

        for ($i = 0; $i < 500000; $i++) {
            $ratings[] = [
                'book_id' => $faker->randomElement($get_bookIds),
                'rating' => $faker->numberBetween(5, 10),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        foreach (array_chunk($ratings, 10000) as $chunk) {
            RatingsModel::insert($chunk);
        }
    }
}
