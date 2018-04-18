<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Model\Project;

class ProjectManageTasksController extends Controller
{
    public function show($id)
    {
      $project = Project::find($id);

      return view('project.manage_tasks_card', ['project' => $project]);
    }
}
