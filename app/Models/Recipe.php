<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipe extends Model implements HasMedia
{
    use InteractsWithMedia, HasFactory;

    const RECIPE_STATUS_DRAFT = 0;
    const RECIPE_STATUS_PUBLISHED = 1;

    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'description',
        'servings',
        'prep_time',
        'prep_time_type',
        'upvotes',
        'downvotes',
        'favorites',
        'created_by',

    ];



    /**
     * The ingredients for the recipe.
     *
     * @return HasMany
     */
    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }


    /**
     * The steps for the recipe.
     *
     * @return HasMany
     */
    public function steps()
    {
        return $this->hasMany(Step::class);
    }


    /**
     * The author of the recipe.
     *
     * @return BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

  
    public function userLastVote()
    {
        return $this->hasOne(Vote::class)
                    ->where('user_id', \Auth::user()?->id)
                    ->orderBy('id', 'desc');
    }
  
    public function userFavorite()
    {
        return $this->hasOne(Favorite::class)
                    ->where('user_id', \Auth::user()?->id)
                    ->orderBy('id', 'desc');
    }

    /**
     * Get the preparation time type as a string.
     *
     * @param int $prepTimeType The type of preparation time (0 for minutes, 1 for hours, others for days).
     * @return string The preparation time type in words.
     */

    public static function getPrepTimeType($prepTimeType) {
        switch ($prepTimeType) {
            case 0:
                return 'minutes';
            case 1:
                return 'hours';
            default: return 'days';
        }
    }

    /**
     * Get the total number of upvotes minus downvotes for the recipe.
     *
     * @return int The total number of votes.
     */
    public function getVotes()
    {
        return $this->upvotes - $this->downvotes;
    }

}
