<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;

class ProjectManageTasksController extends Controller
{
    public function show()
    {
      return view('project.manage_tasks_card');
    }
}