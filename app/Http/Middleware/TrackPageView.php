<?php

namespace App\Http\Middleware;

use App\Services\AnalyticsService;
use Closure;
use Illuminate\Http\Request;

class TrackPageView
{
    public function handle(Request $request, Closure $next)
    {
        // Only track GET requests (page loads)
        if ($request->isMethod('get')) {
            // Avoid tracking admin routes if desired; comment this out to include
            if (!str_starts_with($request->path(), 'admin')) {
                AnalyticsService::trackPageView($request);
            }
        }

        return $next($request);
    }
}


