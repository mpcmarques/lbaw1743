<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Model\Project;
use App\Model\User;
use App\Model\Task;

class SearchUsersController extends Controller{
  public function show($text){
    $projects = Project::nameDescriptionPublic($text)->orderBy('lasteditdate','DESC')->get();
    $projects = SearchController::filterProjects($projects);

    $tasks = Task::where('title', 'ilike', "%{$text}%")->orWhere('description', 'ilike', "%{$text}%")->get();
    $tasks = SearchController::filterTasks($tasks);

    $users = User::usernameName($text)->get();

    return view('search.users_card',
    ['text' => $text,
    'countProjects' => $projects->count(),
    'countTasks' => $tasks->count(),
    'countUsers' => $users->count(),
    'users' => $users]);
  }
}
