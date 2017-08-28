<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class AdminLogin
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
        if(!Session::get('ausers_name')){
            return redirect('/admin/login');
//            dd(456);
        }
//        dd(123);
        return $next($request);
    }
}
