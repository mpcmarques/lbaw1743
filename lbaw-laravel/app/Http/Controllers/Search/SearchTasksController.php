<?php

namespace App\Http\Controllers\Search;

use App\Model\Task;
use App\Http\Controllers\Controller;

class SearchTasksController extends Controller{
  public function show($text){
    $search_title = Task::title($text)->get();
    $search_desc = Task::description($text)->get();

    return view('search.tasks_card', ['text' => $text, 'search_title' => $search_title, 'search_desc' => $search_desc]);
  }
}
