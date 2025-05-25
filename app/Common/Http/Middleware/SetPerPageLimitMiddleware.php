<?php

namespace App\Common\Http\Middleware;

use Closure;

class SetPerPageLimitMiddleware
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
        config(['repository.pagination.limit'=> intval(request()->query('per_page',15))]);

        return $next($request);
    }
}
