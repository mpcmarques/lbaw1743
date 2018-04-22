<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;

class SearchProjectsController extends Controller{
  public function show($text){
    $search_result = null;

    return view('search.projects_card', ['text' => $text, 'search_result' => $search_result]);
  }
}
