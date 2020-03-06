<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Http\Request;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if ($this->isUser()) {
            return $next($request);
        } else {
            if($request->wantsJson()){
                return response(["message"=> "Not Authorized"],401);
            }
            return redirect()->route('user_login');
        }
    }

    private function isUser() {
        return auth()->user() && class_basename(auth()->user()) == "User";
    }
}
