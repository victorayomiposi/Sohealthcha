<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PinAuthentication
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('pinauthenticate')->check()) {
            return $next($request);
        }
        return redirect()->route('online.candidate.index')->with('error', 'You need to be logged in to access this page.');
    }
}
