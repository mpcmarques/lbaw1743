<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;

class ProjectOptionsController extends Controller
{
    public function show()
    {
      return view('project.options_card');
    }
}