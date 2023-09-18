<?php

namespace App\Jobs;

use App\Services\Target\Crud\StoreService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class StoreScrapedData implements ShouldQueue
{
    private string $url;
    private int $depth;
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $timeout = 3600; // 1 hour
    public $tries = 3;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($url, $depth)
    {
        $this->url = $url;
        $this->depth = $depth;
    }

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        Log::info('Job handle method started');
        $storeService = new StoreService(['url' => $this->url, 'depth' => $this->depth]);
        $storeService->response();
        Log::info('Job handle method completed');
    }
}
