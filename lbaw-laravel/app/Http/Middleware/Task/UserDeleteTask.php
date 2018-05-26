<?php

namespace App\Http\Middleware\Task;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Model\Project;
use App\Model\Task;

class UserDeleteTask
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
        $project = Project::findOrFail($request->id);
        $task = Task::findOrFail($request->idTask);

        if( Auth::check() && Auth::user()->can('delete', $task) ){
          return $next($request);
        }
        else{
          return redirect('/project/'.$project->idproject.'/task/'.$task->idtask);
        }
    }
}
