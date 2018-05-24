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

    public function delete($idproject, $idtask){
      $task = Task::find($idtask);

      $task->delete();

      return redirect('/project/'.$idproject);
    }

    public function assign($idproject, $idtask, $iduser){
        Task::find($idtask)->assigned()->attach($iduser);

        return redirect('/project/'.$idproject.'/task/'.$idtask);
    }

    public function unassign($idproject, $idtask, $iduser){
        Task::find($idtask)->assigned()->detach($iduser);

        return redirect('/project/'.$idproject.'/task/'.$idtask);
    }
}
