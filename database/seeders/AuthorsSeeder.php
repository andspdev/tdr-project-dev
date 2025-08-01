<?php

namespace Database\Seeders;

use App\Models\AuthorsModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class AuthorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [];
        $faker = Faker::create();

        $current_time = now();
        for ($i = 0; $i < 1000; $i++) {
            $authors[] = [
                'name' => $faker->name(),
                'created_at' => $current_time,
                'updated_at' => $current_time
            ];
        }

        foreach (array_chunk($authors, 500) as $chunk) {
            DB::table('authors')->insert($chunk);
        }
    }
}
