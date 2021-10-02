<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
class AuthMiddleware
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
        if($request->path()!='login' && $request->path()!='register' && !$request->session()->has('user')){
            // return $request;
            return redirect('login');
        }
        else {
        return $next($request);
        }
    }
}
