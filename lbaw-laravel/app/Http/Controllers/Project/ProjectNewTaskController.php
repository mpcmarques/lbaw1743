<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Model\Project;
use App\Model\Task;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ProjectNewTaskController extends Controller
{
  public function show($id)
  {
    $project = Project::findOrFail($id);

    return view('project.new-task', ['project' => $project]);
  }

  function validator(array $data){
      return Validator::make($data, [
          'title' => 'required|string',
          'description' => 'required|string',
          'deadline' => 'date'
      ]);
  }

  public function newTask(Request $request, $id){
    $this->validator($request->all())->validate();
    $profile = Auth::user();

    $data = $request->all();

    $task = new Task;
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->deadline = $data['deadline'];
    $task->creationdate = date('Y-m-d H:i:s', strtotime(Carbon::now()));
    $task->lasteditdate = date('Y-m-d H:i:s', strtotime(Carbon::now()));
    $task->completed = false;
    $task->completetiondate = null;
    $task->idproject = $id;
    $task->iduser = $profile->iduser;
    $task->save();

    if(empty($task)){
      return redirect('/project/'.$id);
    }

    $project = Project::findOrFail($id);
    $project->lasteditdate = date('Y-m-d H:i:s', strtotime(Carbon::now()));
    $project->save();

    return redirect('/project/'.$id.'/task/'.$task->idtask);
  }
}
