<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Model\Project;
use App\Model\Task;
use App\Model\CloseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TaskNewCloseRequestController extends Controller{
  public function show($idProject, $idTask){
    $project = Project::findOrFail($idProject);
    $task = Task::findOrFail($idTask);

    return view('task.task-new-cr', ['task'=> $task, 'project' => $project]);
  }

  public function newCloseRequest(Request $request, $idproject, $idtask){
    $project = Project::findOrFail($idproject);
    $task = Task::findOrFail($idtask);

    $data = $request->all();

    $closerequest = new CloseRequest;
    $closerequest->title = $data['title'];
    $closerequest->description = $data['description'];
    $closerequest->creationdate = date('Y-m-d H:i:s', strtotime(Carbon::now()));
    $closerequest->approved = false;
    $closerequest->iduser = Auth::user()->iduser;
    $closerequest->idtask= $idtask;
    $closerequest->save();

    return redirect('/project/'.$idproject.'/task/'.$idtask);
  }
}
