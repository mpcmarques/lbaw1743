<?php

namespace App\Http\Middleware\Profile;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Model\User;

class CheckCanSeeProfile
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
        $profile = User::findOrFail($request->id);

        return $next($request);
    }
}
