<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Auth;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    // protected function redirectTo($request)
    // {
    //     // if (! $request->expectsJson()) {
    //     //     return route('login');
    //     // }
    //     if(!Auth::guard('admin')->check()){
    //     return redirect('admin/login');
    // }
    // return $next($request);
    // }
    public function handle($request, Closure $next){
        if(!Auth::guard('admin')->check()){
            return redirect('admin/login');
        }
        return $next($request);
    }

}
