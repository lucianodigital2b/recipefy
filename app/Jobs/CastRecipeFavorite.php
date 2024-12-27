<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Services\FavoriteService;

class CastRecipeFavorite implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(FavoriteService $favoriteService): void

    {
        $favoriteService->updateFavorite($this->data['user_id'], $this->data['id'], $this->data['direction']);

    }
}
