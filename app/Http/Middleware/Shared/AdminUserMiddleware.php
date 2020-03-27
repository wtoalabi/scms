<?php

namespace App\Http\Middleware\Shared;

use Closure;
use Illuminate\Http\Request;

class AdminUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        return $next($request);
    }
}
