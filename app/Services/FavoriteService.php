<?php

namespace App\Services;

use App\Models\Recipe;
use Illuminate\Support\Facades\DB;

class FavoriteService
{
    public function updateFavorite(int $userId, int $recipeId, int $type)
    {
        $recipe = Recipe::findOrFail($recipeId);    

        if($type) {
            $recipe->increment('favorites', 1);
            return DB::table('recipe_user_favorites')->insert([
                'user_id' => $userId,
                'recipe_id' => $recipeId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $recipe->decrement('favorites', 1);
        return DB::table('recipe_user_favorites')
                ->where('user_id', $userId)
                ->where('recipe_id', $recipeId)
                ->delete();
    }
}
