<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Guards
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->role <> 99) {
            abort(403, 'you can\'t access this page.');
        }
        return $next($request);
    }
}
