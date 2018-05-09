<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {

               if (Auth::user()->role == 'Resident') {
                  return redirect('/resident/schedule');
                }elseif(Auth::user()->role == 'Clerk')
                {
                  return redirect('/admin/clerk/request');
                }else{
                  return redirect('/admin/credentials');
                }
        }

        return $next($request);
    }
}
