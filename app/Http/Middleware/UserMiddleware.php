<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // UserMiddleware.php
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 1) {
            return $next($request);
        }
    
        return redirect('/'); // Redirect to the login page or any other route
    }
}