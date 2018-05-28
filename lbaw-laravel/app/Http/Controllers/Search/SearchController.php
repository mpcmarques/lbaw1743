<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

use App\Model\Project;
use App\Model\User;
use App\Model\Task;

class SearchController extends Controller{
  public function search(Request $request){
    $text = $request->input('search-text');

    if(is_null($text)){
      return redirect()->back();
    }
    else{
      return redirect('/search/'.$text);
    }
  }

  public static function filterProjects($projects){
    $visibleProjects = new Collection;

    foreach ($projects as $project) {
      if( (Auth::check() && $project->private && $project->members->contains('iduser', Auth::user()->iduser) )
          || !$project->private || Auth::user()->type == 'admin'){
            $visibleProjects->push($project);
      }
    }

    return $visibleProjects;
  }

  public static function filterTasks($tasks){
    $visibleTasks = new Collection;

    foreach ($tasks as $task) {
      // echo $task .'<br>'.$task->project->private .'<br>';
      if( (Auth::check() && $task->project->private && $task->project->members->contains('iduser', Auth::user()->iduser) )
          || !$task->project->private || Auth::user()->type == 'admin'){
            $visibleTasks->push($task);
      }
    }

    return $visibleTasks;
  }

  public function show($text){
    $projects = Project::nameDescriptionPublic($text)->orderBy('lasteditdate','DESC')->get();
    $projects = SearchController::filterProjects($projects);

    $tasks = Task::where('title', 'ilike', "%{$text}%")->orWhere('description', 'ilike', "%{$text}%")->get();
    $tasks = SearchController::filterTasks($tasks);

    $users = User::usernameName($text)->get();

    if($projects->isEmpty() && $tasks->isEmpty() && $users->isEmpty()){
      //no results
    }

    if($projects->count() >= $tasks->count() && $projects->count() >= $users->count()){
      return view('search.projects_card',
      ['text' => $text,
      'countProjects' => $projects->count(),
      'countTasks' => $tasks->count(),
      'countUsers' => $users->count(),
      'projects' => $projects]);
    } else if($tasks->count() >= $projects->count() && $tasks->count() >= $users->count()){
      return view('search.tasks_card',
      ['text' => $text,
      'countProjects' => $projects->count(),
      'countTasks' => $tasks->count(),
      'countUsers' => $users->count(),
      'tasks' => $tasks]);
    } else{
      return view('search.users_card',
      ['text' => $text,
      'countProjects' => $projects->count(),
      'countTasks' => $tasks->count(),
      'countUsers' => $users->count(),
      'users' => $users]);
    }
  }
}
