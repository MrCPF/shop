<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Auth;
class AdminbusineLogin
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
        if(!Session::get('busines_aname')){
            return redirect('/adminbusine/login');

        }
        return $next($request);
    }
}
