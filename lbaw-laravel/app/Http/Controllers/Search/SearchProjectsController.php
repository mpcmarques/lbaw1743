<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Model\Project;

class SearchProjectsController extends Controller{
  public function show($text){
    $search_name = null;
    $search_desc = null;

    return view('search.projects_card', ['text' => $text, 'projects' => $search_name]);
  }
}
