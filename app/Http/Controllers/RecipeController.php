<?php

namespace App\Http\Controllers;

use App\Services\RecipeService;
use Illuminate\Http\Request;
use App\Http\Requests\{StoreRecipeRequest, UpdateRecipeRequest};
use App\Http\Resources\RecipeResource;

class RecipeController extends Controller
{
    protected $recipeService;

    public function __construct(RecipeService $recipeService)
    {
        $this->recipeService = $recipeService;
    }

    public function index()
    {
        $recipes = $this->recipeService->getPublishedRecipes();
        return response()->json($recipes);
    }

    public function show($id)
    {
        $recipe = $this->recipeService->getRecipeById($id);
        return response()->json($recipe);
    }

    public function store(StoreRecipeRequest  $request)
    {
        $recipe = $this->recipeService->createRecipe($request->all());
        return response()->json($recipe, 201);
    }

    public function update(UpdateRecipeRequest  $request, $id)
    {
        $recipe = $this->recipeService->updateRecipe($id, $request->all());
        return response()->json($recipe);
    }

    public function destroy($id)
    {
        $this->recipeService->deleteRecipe($id);
        return response()->json(null, 204);
    }
}
