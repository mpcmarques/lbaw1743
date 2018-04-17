<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;

use App\Task;
use App\Project;

class TaskEditController extends Controller
{
    public function show($idproject, $idtask)
    {
      $project = Project::find($idproject);
      $task = Task::find($idtask);

      return view('task_edit', ['task' => $task, 'project' => $project]);
    }
}