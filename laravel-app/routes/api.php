<?php

use App\Http\Controllers\CrawlerController;
use App\Http\Controllers\TargetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::middleware(['scraper.rate.limiter'])->group(function () {
    Route::post('/targets/store', [TargetController::class, 'store']);
    Route::put('/targets/update', [TargetController::class, 'update']);
//});
