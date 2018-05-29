<?php

namespace App\Http\Middleware\Project;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Model\Project;

class ProjectMember
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
        $project = Project::findOrFail($request->id);

        if (Auth::check() && Auth::user()->can('member', $project)){
          return $next($request);
        }
        else{
          return redirect('/project/'.$project->idproject);
        }
    }
}
