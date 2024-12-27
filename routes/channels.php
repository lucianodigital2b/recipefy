<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


Broadcast::channel('recipe-votes.{id}', function ($user, $id) {
    // return (int) $user->id === (int) $id;
});


Broadcast::channel('recipe-favorites.{id}', function ($user, $id) {
    // return (int) $user->id === (int) $id;
});