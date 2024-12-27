<?php

namespace App\Services;

use App\Models\Recipe;
use App\Services\IngredientService;
use App\Services\StepService;
use Auth;
use Storage;
use Str;

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
    public function getPublishedRecipes()
    {
        return Recipe::where('status', Recipe::RECIPE_STATUS_PUBLISHED)->with('ingredients', 'author', 'steps', 'userLastVote', 'userFavorite')->paginate(10);
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

        if (isset($data['thumbnail'])) {

            $filename = uniqid() . '.' . $data['thumbnail']->getClientOriginalExtension();
            $path = Storage::disk('public')->putFileAs('uploads/recipes', $data['thumbnail'], $filename);

            $data['thumbnail'] = $path;

        }

        $data['created_by'] = Auth::user()->id;
        $data['slug'] = Str::slug($data['title'], "-");

        $recipe = Recipe::create($data);

        if (isset($data['ingredients'])) {
            $this->ingredientService->createIngredients($recipe->id, $data['ingredients']);
        }

        if (isset($data['steps'])) {
            $this->stepService->createSteps($recipe->id, $data['steps']);
        }
        
        return $recipe;
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
