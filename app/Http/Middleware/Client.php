<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Client
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
     
        if (Auth::check() && Auth::user()->role_id == '3') {
            return $next($request);
        }
        elseif (Auth::check() && Auth::user()->role_id == '2') {
            return redirect('/back-office');
        }
        elseif (Auth::check() && Auth::user()->role_id == '1') {
            return redirect('/admin');
        }
        else {
            return redirect('/');
        }        
    }
}
