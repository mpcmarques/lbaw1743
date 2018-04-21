<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Model\Project;
use App\Model\Task;

class ProjectTasksController extends Controller
{
  public function show($id)
  {
    $project = Project::findOrFail($id);

    return view('project.tasks_card', ['project' => $project]);
  }
}
