<?php

namespace App\Common\Http\Middleware;

use Closure;
use App\Domain\Setting\Repositories\Contracts\BlockIpRepository;
use Illuminate\Support\Facades\Route;

class BlockIpMiddleware
{

    /**
     * Define User Repository
     *
     * @var BlockIpRepository
     */
    private $blockIpRepository;


    /**
     * Initialize BlockIpRepository
     */
    public function __construct()
    {
        $this->blockIpRepository = app()->make(BlockIpRepository::class);    
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $exists = $this->blockIpRepository->where('ip_address', request()->ip())->exists();

        if($exists && Route::currentRouteName() != 'blocked'){
            return redirect()->route('blocked');
        }else if(!$exists && Route::currentRouteName() == 'blocked'){
            return redirect()->route('home');
        }else{
            return $next($request);
        }
    }
}
