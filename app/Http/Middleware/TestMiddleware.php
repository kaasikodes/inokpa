<?php

namespace App\Http\Middleware;
use App\Events\UserLoggedInEvent;

use Closure;

class TestMiddleware
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
        // event(new UserLoggedInEvent(auth()->user()));
        dd(auth()->user()->id);
        return $next($request);
    }
}