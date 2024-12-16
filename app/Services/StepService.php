<?php

namespace App\Services;

use App\Models\Step;

class StepService
{
    /**
     * Create steps for a recipe.
     */
    public function createSteps(int $recipeId, array $steps)
    {
        foreach ($steps as $order => $description) {
            Step::create([
                'recipe_id' => $recipeId,
                'description' => $description,
                'order' => $order + 1, // Steps should be 1-based index
            ]);
        }
    }

    /**
     * Update steps for a recipe.
     */
    public function updateSteps(int $recipeId, array $steps)
    {
        // Delete existing steps
        Step::where('recipe_id', $recipeId)->delete();

        // Create new steps
        $this->createSteps($recipeId, $steps);
    }
}
