<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->usertype == 1) {
            return $next($request); // User is admin
        }


        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json(['message' => 'Access denied. Admins only.'], 403);
        }
        
        // Not admin — redirect or abort
        return redirect('/')->with('error', 'Access denied. Admins only.');
    }
}
