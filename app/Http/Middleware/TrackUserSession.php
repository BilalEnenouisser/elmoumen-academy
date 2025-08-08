<?php

namespace App\Http\Middleware;

use App\Services\AnalyticsService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackUserSession
{
    public function handle(Request $request, Closure $next)
    {
        // Proceed with the request first to ensure session is started
        $response = $next($request);

        // Track web user sessions
        if (Auth::check()) {
            $sessionId = $request->session()->getId();
            AnalyticsService::trackUserSession(Auth::id(), $sessionId);
        }

        // Track teacher sessions
        if (Auth::guard('teacher')->check()) {
            $sessionId = $request->session()->getId();
            $teacher = Auth::guard('teacher')->user();
            AnalyticsService::trackTeacherSession($teacher->id, $sessionId);
        }

        return $response;
    }
}


