<?php

namespace App\Services;

use App\Models\Recipe;
use Illuminate\Support\Facades\DB;

class VoteService
{
    public function vote(int $userId, int $recipeId, int $type)
    {
        DB::table('recipes_users_votes')->insert([
            'user_id' => $userId,
            'recipe_id' => $recipeId,
            'type' => $type,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

}
