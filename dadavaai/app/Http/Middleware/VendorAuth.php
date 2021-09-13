<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class VendorAuth
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
        if (!Session::has('VENDOR_ID')) {
            return redirect('/vendor-login');
        }

        return $next($request);
    }
}
