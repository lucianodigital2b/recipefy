<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Services\VoteService;

class CastRecipeVote implements ShouldQueue
{
    use Queueable;


    public function __construct(public array $data,)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(VoteService $voteService): void
    {
        $voteService->vote($this->data['user_id'], $this->data['id'], $this->data['direction']);
        
    }
}
