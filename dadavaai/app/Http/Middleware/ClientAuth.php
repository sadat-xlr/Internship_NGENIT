<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class ClientAuth
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
        if (!Session::has('CLIENT_ID')) {
            return redirect('/client-login-register');
        }

        return $next($request);
    }
}
