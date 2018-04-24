<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;

use App\Model\Project;
use App\Model\User;
use App\Model\Task;

class SearchUsersController extends Controller{
  public function show($text){
    $projects = Project::nameDescription($text)->get();
    $tasks = Task::titleDescription($text)->get();
    $users = User::usernameName($text)->get();

    return view('search.users_card',
    ['text' => $text,
    'countProjects' => $projects->count(),
    'countTasks' => $tasks->count(),
    'countUsers' => $users->count(),
    'users' => $users]);
  }
}
