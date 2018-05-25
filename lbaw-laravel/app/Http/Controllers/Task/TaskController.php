<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;

use App\Model\Task;
use App\Model\Project;
use Carbon\Carbon;

class TaskController extends Controller
{
  public function show($idProject, $idTask)
  {
    $project = Project::find($idProject);
    $task = Task::find($idTask);

    return view('task.task', ['task'=> $task, 'project' => $project]);
  }

  public function delete($idproject, $idtask){
    $task = Task::find($idtask);

    $comments = $task->comments()->get();
    foreach($comments as $comment){
      $comment->delete();
    }

    $closerequests = $task->closeRequest()->get();
    foreach($closerequests as $closerequest){
      $closerequest->delete();
    }

    $task->tags()->detach();
    $task->assigned()->detach();

    $task->delete();

    return redirect('/project/'.$idproject);
  }

  public function update($idtask){
    $task = Task::find($idtask);
    $task->lasteditdate = date('Y-m-d H:i:s', strtotime(Carbon::now()));
    $task->save();
  }

  public function assign($idproject, $idtask, $iduser){
    Task::find($idtask)->assigned()->attach($iduser);

    $this->update($idtask);

    return redirect('/project/'.$idproject.'/task/'.$idtask);
  }
}
