<?php

namespace App\Services;

use App\Models\Recipe;
use Illuminate\Support\Facades\DB;
use App\Events\RecipeFavoriteChanged;

class FavoriteService
{
    public function updateFavorite(int $userId, int $recipeId, int $type)
    {
        $recipe = Recipe::findOrFail($recipeId);    

        if($type) {
            $recipe->increment('favorites', 1);
            $response = DB::table('recipe_user_favorites')->insert([
                'user_id' => $userId,
                'recipe_id' => $recipeId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            broadcast(new RecipeFavoriteChanged([
                'user_id' => $userId,
                'recipe_id' => $recipeId,
                'type' => $type,
            ]));

            return $response;
        }

        $recipe->decrement('favorites', 1);

        $response = DB::table('recipe_user_favorites')
                ->where('user_id', $userId)
                ->where('recipe_id', $recipeId)
                ->delete();

        broadcast(new RecipeFavoriteChanged([
            'user_id' => $userId,
            'recipe_id' => $recipeId,
            'type'      => -1
        ]));

        return $response;
    }
}
