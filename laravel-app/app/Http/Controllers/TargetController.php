<?php

namespace App\Http\Controllers;

use App\Http\Requests\Target\StoreRequest;
use App\Jobs\StoreScrapedData;
use App\Services\Target\TargetService;
use Exception;
use Illuminate\Support\Facades\Log;

class TargetController extends Controller
{
    /**
     * @throws Exception
     */
    public function store(StoreRequest $request)
    {
        try {
            extract($request->validated());

//            StoreScrapedData::dispatch($url, $depth);
//            return response()->json(['message' => 'Scrape job dispatched']); // uncomment for larger scraping jobs.

            return  TargetService::Store($request->validated())->response();

        } catch (Exception $exception) {
            return response($exception->getMessage(), 400);
        }

    }
}
