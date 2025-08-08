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

        // Track teacher sessions by mapping teacher -> user (via email)
        if (Auth::guard('teacher')->check()) {
            $sessionId = $request->session()->getId();
            // AnalyticsService handles mapping internally when passing null userId under teacher guard
            // but trackUserSession needs a user id, so map here similarly
            $teacher = Auth::guard('teacher')->user();
            $user = \App\Models\User::where('email', $teacher->email)->first();
            if ($user) {
                AnalyticsService::trackUserSession($user->id, $sessionId);
            }
        }

        return $response;
    }
}


