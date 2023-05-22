<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MealsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));
        foreach (range(1,10) as $index) {
            DB::table('meals')->insert([
                'title' => $faker->foodName(),
                'description' => $faker->realTextBetween($minNbChars=5,$maxNbChars=10,$indexSize = 2),
                'status' => 'Not implemented',
                'created_at' => now(),
                'updated_at' => now(),
                'category_id' => rand(0, DB::table('categories')->count())
            ]);
        }
    }
}
