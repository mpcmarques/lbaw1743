<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;

class ProjectTasksController extends Controller
{
    public function show()
    {
      return view('project.tasks_card');
    }
}