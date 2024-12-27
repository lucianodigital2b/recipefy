<?php

namespace App\Services;

use App\Models\Recipe;
use Illuminate\Support\Facades\DB;
use App\Events\RecipeVoteChanged;

class VoteService
{
    public function vote(int $userId, int $recipeId, int $type)
    {

        $recipe = Recipe::findOrFail($recipeId);    
        $type == 1 ? $recipe->increment('upvotes', 1) : $recipe->decrement('upvotes', 1);


        DB::table('recipe_user_votes')->insert([
            'user_id' => $userId,
            'recipe_id' => $recipeId,
            'type' => $type,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        broadcast(new RecipeVoteChanged([
            'user_id' => $userId,
            'recipe_id' => $recipeId,
            'type' => $type,
        ]))->toOthers();
    }

}
