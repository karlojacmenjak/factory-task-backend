<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        for ($i=0; $i < DB::table('meals')->count(); $i++) { 
            /* DB::table('meals_tags')->insert([
                'meals_id' => $i,
                'tags_id' => rand(1, DB::table('tags')->count())
            ]); */
            DB::table('meals_ingredients')->insert([
                'meals_id' => $i,
                'ingredients_id' => rand(1, DB::table('ingredients')->count())
            ]);
        }
        //rand(0, DB::table('categories')->count())
        /* $this->call([
            CategorySeeder::class,
            TagsSeeder::class,
            IngredientsSeeder::class,
            MealsSeeder::class
        ]); */
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
