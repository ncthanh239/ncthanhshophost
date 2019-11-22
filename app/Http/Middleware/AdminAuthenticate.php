<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AdminAuthenticate 
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
   public function handle($request, Closure $next){
    if(!Auth::guard('admin')->check()) {
            return redirect('admin/login');
        }
        return $next($request);
   }
}
