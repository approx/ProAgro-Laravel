<?php

namespace App\Http\Middleware;

use Closure;

class OnlyMaster
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
        if(Auth::user()->role->name!='master'){
          return response('you dont have access',401);
        }

        return $next($request);
    }
}
