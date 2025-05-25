<?php

namespace App\Common\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MarkNotificationRead
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
        if($request->has('notification')){
            auth()->user()->unreadNotifications->where('id', $request->get('notification'))->markAsRead();
        }

        return $next($request);
    }
}
