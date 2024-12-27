<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind services to the service container
        $this->app->bind('RecipeService', function ($app) {
            return new RecipeService();
        });
        
        $this->app->bind('IngredientService', function ($app) {
            return new IngredientService();
        });
        
        $this->app->bind('StepService', function ($app) {
            return new StepService();
        });
        
        $this->app->bind('VoteService', function ($app) {
            return new VoteService();
        });
        
        $this->app->bind('FavoriteService', function ($app) {
            return new FavoriteService();
        });
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
