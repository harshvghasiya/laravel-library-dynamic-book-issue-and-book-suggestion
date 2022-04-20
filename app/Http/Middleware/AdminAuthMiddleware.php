<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminAuthMiddleware
{

    /**
     * [handle This function is used to check admin user is login or not if not login then it will 
     * redirect to login page]
     * @param  [type]  $request [description]
     * @param  Closure $next    [description]
     * @return [type]           [description]
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check())
        {
            return redirect()->route('admin.login.main');
        }
        
        return $next($request);
    }
}
