<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Http\Requests\{VoteRequest, FavoriteRequest};
use App\Jobs\{CastRecipeVote, CastRecipeFavorite};

class RecipeActionController extends Controller
{


    public function updateFavorite(int $id, FavoriteRequest $request)
    {
        
        CastRecipeFavorite::dispatch([...$request->all(), 'user_id' => auth()->id(), 'id' => $id]);
        return response()->json(['message' => 'Recipe favorited successfully']);
    }

    public function updateVote(int $id, VoteRequest $request)
    {

        CastRecipeVote::dispatch([...$request->all(), 'user_id' => auth()->id(), 'id' => $id]);

        return response()->json(['message' => 'Vote is being processed']);
    }


}
