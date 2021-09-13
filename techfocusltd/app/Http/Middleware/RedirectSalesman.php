<?php

namespace App\Http\Middleware;

use Session;
use Closure;

class RedirectSalesman
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
        if (!Session::has('salesman_id')) {
            return redirect('/sales_login');
        }

        return $next($request);
    }
}
