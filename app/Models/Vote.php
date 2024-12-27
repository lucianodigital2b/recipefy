<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = 'recipe_user_votes';

    protected $fillable = [
        'type',
        'user_id',
        'recipe_id',
    ];
}
