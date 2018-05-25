<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;

class TaskNewCloseRequestController extends Controller{
  public function show($idProject, $idTask){
    $project = Project::find($idProject);
    $task = Task::find($idTask);

    return view('task.task-new-cr', ['task'=> $task, 'project' => $project]);
  }
}
