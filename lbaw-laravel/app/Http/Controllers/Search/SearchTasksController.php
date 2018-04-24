<?php

namespace App\Http\Controllers\Search;

use App\Model\Task;
use App\Http\Controllers\Controller;

class SearchTasksController extends Controller{
  public function show($text){
    $tasks = Task::titleDescription($text)->get();

    return view('search.tasks_card', ['text' => $text, 'tasks' => $tasks]);
  }
}
