<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\RateLimiter;

class ScraperRateLimiter
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if (RateLimiter::tooManyAttempts('scraper-' . $request->ip(), 10)) {
            return response('Too Many Attempts', 429);
        }

        RateLimiter::hit('scraper-' . $request->ip());

        return $next($request);    }
}
