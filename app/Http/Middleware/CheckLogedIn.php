<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLogedIn
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
        // Kiem tra neu dang nhap roi thi vao trong home index QTV
        if(Auth::check())
        {
            // Người dùng đã đăng nhập, chuyển hướng đến trang admin/index hoặc user/index
            return Auth::user()->role === 2 ? redirect()->intended('admin/index') : redirect()->intended('user/index');
        }

        // Nếu chưa đăng nhập, cho phép truy cập tiếp theo
        return $next($request);
    }
}
