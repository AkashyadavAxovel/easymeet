<?php

namespace App\Http\Middleware;

use Closure;
use App\App42\App42API; 

class AppInitialize
{
    public function __construct()
    {
        App42API::initialize(env('APP42_APIKEY'),env('APP42_SECRETKEY'));
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
        return $next($request);
    }

    public static function initUserService()
    {
        return App42API::buildUserService();
    }
}
