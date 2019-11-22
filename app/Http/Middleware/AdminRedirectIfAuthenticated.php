<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminRedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::guard('admin')->check()) {
            return redirect('admin/dashboard');
        }
        return $next($request);
    }
}
