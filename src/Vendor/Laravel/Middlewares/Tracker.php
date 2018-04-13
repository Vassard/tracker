<?php

namespace PragmaRX\Tracker\Vendor\Laravel\Middlewares;

use Closure;
use Config;

class Tracker
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try{
            if (Config::get('tracker.enabled')) {
                app('tracker')->boot();
            }
        }catch (\Exception $e){
            if(env("DEBUG", false))
                return;

            return $next($request);
        }


        return $next($request);
    }
}
