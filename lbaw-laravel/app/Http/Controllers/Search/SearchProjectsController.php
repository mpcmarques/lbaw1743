<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;

use App\Model\Project;
use App\Model\User;
use App\Model\Task;

class SearchProjectsController extends Controller{
  public function show($text){
    $projects = Project::nameDescriptionPublic($text)->get();
    $tasks = Task::titleDescription($text)->get();
    $users = User::usernameName($text)->get();

    return view('search.projects_card',
    ['text' => $text,
    'countProjects' => $projects->count(),
    'countTasks' => $tasks->count(),
    'countUsers' => $users->count(),
    'projects' => $projects]);
  }
}
