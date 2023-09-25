<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLogedOut
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Kiem tra neu chua dang nhap thi ve trang login
        if(Auth::guest())
        {
            return redirect()->intended('login');
        }
        return $next($request);

        // if (!session('user_role')) {
        //     return redirect()->intended('login');
        // }
        
        // return $next($request);
    }
}
