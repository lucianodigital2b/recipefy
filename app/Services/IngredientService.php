<?php

namespace App\Services;

use App\Models\Ingredient;

class IngredientService
{
    /**
     * Create ingredients for a recipe.
     */
    public function createIngredients(int $recipeId, array $ingredients)
    {
        foreach ($ingredients as $ingredient) {
            Ingredient::create([
                'recipe_id' => $recipeId,
                'name' => $ingredient,
            ]);
        }
    }

    /**
     * Update ingredients for a recipe.
     */
    public function updateIngredients(int $recipeId, array $ingredients)
    {
        // Delete existing ingredients
        Ingredient::where('recipe_id', $recipeId)->delete();

        // Create new ingredients
        $this->createIngredients($recipeId, $ingredients);
    }
}
