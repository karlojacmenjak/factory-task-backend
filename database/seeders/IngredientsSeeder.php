<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class IngredientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));

        $rand_list = array($faker->vegetableName(), $faker->fruitName(), $faker->meatName(), $faker->sauceName());
        shuffle($rand_list);
        foreach (range(1,10) as $index) {
            DB::table('ingredients')->insert([
                'title' => $rand_list[0],
                'slug' => $faker->realTextBetween($minNbChars=5,$maxNbChars=10,$indexSize = 2)
            ]);
        }
    }
}
