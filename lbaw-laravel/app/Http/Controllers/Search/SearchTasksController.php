<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;

class SearchTasksController extends Controller
{
    public function show()
    {
      return view('search.tasks_card');
    }
}