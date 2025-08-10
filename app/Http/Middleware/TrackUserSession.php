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
        $response = $next($request);

        if (Auth::guard('web')->check()) {
            $sessionId = $request->session()->getId();
            $user = Auth::guard('web')->user();
            if ($user) {
                AnalyticsService::trackUserSession($user->id, $sessionId);
            }
        }

        if (Auth::guard('teacher')->check()) {
            $sessionId = $request->session()->getId();
            $teacher = Auth::guard('teacher')->user();
            if ($teacher) {
                AnalyticsService::trackTeacherSession($teacher->id, $sessionId);
            }
        }

        return $response;
    }
}


