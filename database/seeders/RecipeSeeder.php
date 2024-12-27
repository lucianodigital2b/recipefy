<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{Recipe, Ingredient, Step, User};

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::factory(100)->create();

        Recipe::factory(10000)
            ->has(Ingredient::factory(5)) // 5 ingredients per recipe
            ->has(Step::factory(5)->sequence(fn ($sequence) => ['order' => $sequence->index + 1])) // Unique step orders per recipe
            ->create();

    }
}
