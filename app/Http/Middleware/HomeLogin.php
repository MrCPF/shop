<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class HomeLogin
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
        /*if(!session('admin_user')){
//        if(0){
            return redirect('/auth/login');
        }*/
        if (!Auth::check())
        {
            return redirect('/auth/login');
        }
        return $next($request);
    }
}
