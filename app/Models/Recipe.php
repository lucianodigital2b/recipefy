<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Recipe extends Model implements HasMedia
{
    use InteractsWithMedia;

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
     * Get the ingredients for the recipe.
     */
    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }

    /**
     * Get the steps for the recipe.
     */
    public function steps()
    {
        return $this->hasMany(Step::class);
    }


}
