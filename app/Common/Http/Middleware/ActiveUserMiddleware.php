<?php

namespace App\Common\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ActiveUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request $request
     * @param  Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if (Auth::check() && Auth::user()->status != 'active') {
            Session::flush();
        
            Auth::logout();

            session()->flash('message', ['type'=>'info', 'message'=> 'Your account has been deactivated by the administration.<br/> Contact the adminstration to reactivate it.']);

            return redirect()->route('home');
        }

        return $next($request);
    }
}
