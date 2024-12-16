<?php

namespace App\Services;

use App\Models\Recipe;
use App\Services\IngredientService;
use App\Services\StepService;

class RecipeService
{

    protected $ingredientService;
    protected $stepService;

    public function __construct(IngredientService $ingredientService, StepService $stepService)
    {
        $this->ingredientService = $ingredientService;
        $this->stepService = $stepService;
    }

    /**
     * Get all recipes.
     */
    public function getAllRecipes()
    {
        return Recipe::all();
    }

    /**
     * Get a single recipe by ID.
     */
    public function getRecipeById(int $id)
    {
        return Recipe::findOrFail($id);
    }

    /**
     * Create a new recipe.
     */
    public function createRecipe(array $data)
    {

        if (isset($data['ingredients'])) {
            $this->ingredientService->createIngredients($recipe->id, $data['ingredients']);
        }

        if (isset($data['steps'])) {
            $this->stepService->createSteps($recipe->id, $data['steps']);
        }
        
        return Recipe::create($data);
    }

    /**
     * Update an existing recipe.
     */
    public function updateRecipe(int $id, array $data)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->update($data);

        if (isset($data['ingredients'])) {
            $this->ingredientService->updateIngredients($id, $data['ingredients']);
        }

        if (isset($data['steps'])) {
            $this->stepService->updateSteps($id, $data['steps']);
        }

        return $recipe;
    }

    /**
     * Delete a recipe.
     */
    public function deleteRecipe(int $id)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->delete();

        return true;
    }
}
