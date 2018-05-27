<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;

use App\Model\Task;
use App\Model\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
  public function show($idProject, $idTask)
  {
    $project = Project::findOrFail($idProject);
    $task = Task::findOrFail($idTask);

    return view('task.task', ['task'=> $task, 'project' => $project]);
  }

  public static function delete($idproject, $idtask){
    $task = Task::findOrFail($idtask);

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
    $task = Task::findOrFail($idtask);
    $task->lasteditdate = date('Y-m-d H:i:s', strtotime(Carbon::now()));
    $task->save();
  }

  public function assign($idproject, $idtask){
    Task::findOrFail($idtask)->assigned()->attach(Auth::user()->iduser);

    $this->update($idtask);

    return redirect('/project/'.$idproject.'/task/'.$idtask);
  }

  public function unassign($idproject, $idtask){
    Task::findOrFail($idtask)->assigned()->detach(Auth::user()->iduser);

    $this->update($idtask);

    return redirect('/project/'.$idproject.'/task/'.$idtask);
  }
}
