<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;

use App\Model\Task;
use App\Model\Project;

class TaskController extends Controller
{
    public function show($idProject, $idTask)
    {
      $project = Project::find($idProject);
      $task = Task::find($idTask);

      return view('task', ['task'=> $task, 'project' => $project]);
    }
}