<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->isAdmin()) {
            return $next($request);
        } else {
            if($request->wantsJson()){
                return response(["message"=> "Not Authorized"],401);
            }
            return redirect()->route('admin_login');
        }
    }
    private function isAdmin() {
        return auth('admin')->user() && class_basename(auth('admin')->user()) == "Admin";
    }
}
