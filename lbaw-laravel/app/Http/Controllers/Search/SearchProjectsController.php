<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Model\Project;

class SearchProjectsController extends Controller{
  public function show($text){
    $search_name = Project::name($text)->get();
    $search_desc = Project::description($text)->get();

    return view('search.projects_card', ['text' => $text, 'search_name' => $search_name, 'search_desc' => $search_desc]);
  }
}
