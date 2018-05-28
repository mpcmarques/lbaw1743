<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Model\User;

class CheckAdminUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null){
        if(Auth::check() && Auth::user()->type == 'admin'){
          return $next($request);
        }
        else if(Auth::check()){
          return redirect('/dashboard');
        }
        else{
          return redirect('/login');
        }
    }
}
