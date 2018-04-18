<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Model\Project;

class ProjectTasksController extends Controller
{
    public function show($id)
    {
      $project = Project::find($id);

      return view('project.tasks_card', ['project' => $project]);
    }
}
