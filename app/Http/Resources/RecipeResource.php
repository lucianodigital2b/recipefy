<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use App\Models\Recipe;

class RecipeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'thumbnail' => $this->thumbnail,
            'description' => $this->description,
            'servings' => $this->servings,
            'prep_time' => $this->prep_time,
            'prep_time_type' => $this->prep_time_type,
            'prep_time_type_formatted' => Recipe::getPrepTimeType($this->prep_time_type),
            'upvotes' => $this->upvotes,
            'downvotes' => $this->downvotes,
            'votes'     => $this->getVotes(),
            'favorites' => $this->favorites,
            'created_at' => Carbon::parse($this->created_at)->format('M d, Y'),
			'author' => $this->whenLoaded('author', $this->author),
			'steps' => $this->whenLoaded('steps', $this->steps),
			'ingredients' => $this->whenLoaded('ingredients', $this->ingredients),
        ];
    }
}
