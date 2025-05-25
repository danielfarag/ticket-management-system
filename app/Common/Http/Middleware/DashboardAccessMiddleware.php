<?php

namespace App\Common\Http\Middleware;
use Closure;

class DashboardAccessMiddleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function handle($request, Closure $next)
    {

        if($request->route()->getPrefix() == '/dashboard' && auth()->check()){
            if (auth()->user()->type !== 'user') {
                return $next($request);
            }else{
                return redirect()->route('home');
            }
        }else{
            return $next($request);
        }
    }
}
