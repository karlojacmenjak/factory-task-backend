<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach (range(1,10) as $index) {
            DB::table('tags')->insert([
                'title' => $faker->realTextBetween($minNbChars=5,$maxNbChars=10,$indexSize = 2),
                'slug' => $faker->realTextBetween($minNbChars=5,$maxNbChars=10,$indexSize = 2)
            ]);
        }
    }
}
