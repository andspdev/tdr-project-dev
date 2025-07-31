<?php

namespace Database\Seeders;

use App\Models\AuthorsModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AuthorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [];
        $faker = Faker::create();
        for ($i = 0; $i < 1000; $i++) {
            $authors[] = [
                'name' => $faker->name(),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        foreach (array_chunk($authors, 500) as $chunk) {
            AuthorsModel::insert($chunk);
        }
    }
}
