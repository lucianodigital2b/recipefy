<?php

namespace App\Http\Controllers;

use App\Services\RecipeService;
use Illuminate\Http\Request;
use App\Http\Requests\{StoreRecipeRequest, UpdateRecipeRequest};
use App\Http\Resources\RecipeResource;

class RecipeController extends Controller
{
    protected $recipeService;

    /**
     * Inject the RecipeService into the controller.
     *
     * @param RecipeService $recipeService
     */
    public function __construct(RecipeService $recipeService)
    {
        $this->recipeService = $recipeService;
    }


    /**
     * Get all published recipes
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $recipes = $this->recipeService->getPublishedRecipes();
        return RecipeResource::collection($recipes);
    }

    /**
     * Display the specified recipe.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function show($id)
    {
        $recipe = $this->recipeService->getRecipeById($id);
        return response()->json(RecipeResource::make($recipe));
    }

    /**
     * Create a new recipe
     *
     * @param StoreRecipeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRecipeRequest  $request)
    {
        $recipe = $this->recipeService->createRecipe($request->all());
        return response()->json($recipe, 201);
    }



    /**
     * Update an existing recipe.
     *
     * @param UpdateRecipeRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRecipeRequest $request, $id)
    {
        if ($request->user()->id !== $request->user_id) {
            return response()->json(['message' => 'You are not authorized to update this recipe.'], 403);
        }
        
        $recipe = $this->recipeService->updateRecipe($id, $request->all());
        return response()->json($recipe);
    }

    /**
     * Delete a recipe.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function destroy($id)
    {
        $this->recipeService->deleteRecipe($id);
        return response()->json(null, 204);
    }
}
