<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class SiteAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!(Auth::user() && Auth::user()->isSiteAdmin())){
            Auth::logout();
            return redirect('/login');
        }

        return $next($request);
    }
}
