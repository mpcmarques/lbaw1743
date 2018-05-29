<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Model\Project;
use App\Model\Task;

class ProjectTasksController extends Controller
{
  public function show($id){
    $project = Project::findOrFail($id);
    $tasks = $project->tasks()->where('task.completed', 'false')->get();

    return view('project.tasks_card', ['project' => $project, 'tasks' => $tasks]);
  }

  public function showUnassigned($id){
    $project = Project::findOrFail($id);
    $tasks = $project->tasks()->has('assigned','=','0')->get();

    return view('project.tasks_card', ['project' => $project, 'tasks' => $tasks]);
  }

  public function showCompleted($id){
    $project = Project::findOrFail($id);
    $tasks = $project->tasks()->where('task.completed', 'true')->get();

    return view('project.tasks_card', ['project' => $project, 'tasks' => $tasks]);
  }
}
