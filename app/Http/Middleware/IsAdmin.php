<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && auth()->user()->role !== 'admin') {
            return redirect()->route('auth.login')->with('error', 'Unauthorized access');
        }

        return $next($request);
    }
}
