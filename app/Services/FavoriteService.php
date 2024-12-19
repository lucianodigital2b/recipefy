<?php

namespace App\Services;

use App\Models\Recipe;
use Illuminate\Support\Facades\DB;

class FavoriteService
{
    public function updateFavorite(int $userId, int $recipe, int $type)
    {
        if($type) {
            return DB::table('recipes_users_favorites')->insert([
                'user_id' => $userId,
                'recipe_id' => $recipe,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return DB::table('recipes_users_favorites')
                ->where('user_id', $userId)
                ->where('recipe_id', $recipe)
                ->delete();
    }
}
