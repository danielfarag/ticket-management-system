<?php

namespace App\Common\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if($request->expectsJson()){
                return response()->json(['message'=>'Forbidden'],403);
            }else{
                if ($request->route()->getPrefix() == '/dashboard') {
                    return redirect()->route('dashboard');
                }else{
                    return redirect()->route('home');
                }
            }
        }

        return $next($request);
    }
}
