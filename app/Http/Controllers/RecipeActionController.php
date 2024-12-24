<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Services\FavoriteService;
use App\Services\VoteService;
use App\Http\Requests\{VoteRequest, FavoriteRequest};

class RecipeActionController extends Controller
{
    protected $favoriteService;
    protected $voteService;

    public function __construct(FavoriteService $favoriteService, VoteService $voteService)
    {
        $this->favoriteService = $favoriteService;
        $this->voteService = $voteService;
    }

    public function updateFavorite(int $id, FavoriteRequest $request)
    {
        $this->favoriteService->updateFavorite(auth()->id(), $id, $request->direction);
        return response()->json(['message' => 'Recipe favorited successfully']);
    }

    public function updateVote(int $id, VoteRequest $request)
    {

        $this->voteService->vote(auth()->id(), $id, $request->direction);
        
        return response()->json(['message' => 'Vote upvoted successfully']);
    }


}
