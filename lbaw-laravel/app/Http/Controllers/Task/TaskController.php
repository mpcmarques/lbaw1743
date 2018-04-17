<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;

use App\Task;
use App\Project;

class TaskController extends Controller
{
    public function show($idProject, $idTask)
    {
      $project = Project::find($idProject);
      $task = Task::find($idTask);

      return view('task', ['task'=> $task, 'project' => $project]);
    }
}