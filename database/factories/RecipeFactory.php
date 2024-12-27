<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Recipe;
use Carbon\Carbon;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{

    protected $model = Recipe::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'slug' => $this->faker->slug,
            'servings' => $this->faker->numberBetween(1, 10),
            'prep_time' => $this->faker->numberBetween(1, 10),
            'prep_time_type' => $this->faker->numberBetween(1, 3),
            'upvotes' => $this->faker->numberBetween(1, 100),
            'downvotes' => $this->faker->numberBetween(1, 100),
            'favorites' => $this->faker->numberBetween(1, 100),
            // 'created_by' => User::factory(),
            'created_by' => function () {
                if ($user = User::inRandomOrder()->first()) {
                    return $user->id;
                }

                return factory(User::class)->create()->id;
            },
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
