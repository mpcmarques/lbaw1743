<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;

class SearchProjectsController extends Controller
{
    public function show($text)
    {
      return view('search.projects_card');
    }
}