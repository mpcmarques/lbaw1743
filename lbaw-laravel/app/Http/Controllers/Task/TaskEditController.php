<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;

use App\Model\Task;
use App\Model\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskEditController extends Controller
{
    public function show($idproject, $idtask)
    {
      $project = Project::find($idproject);
      $task = Task::find($idtask);

      return view('task_edit', ['task' => $task, 'project' => $project]);
    }

    function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|string',
            'description' => 'required|string',
        ]);
    }

    public function editTask(Request $request, $idproject, $idtask){
      $this->validator($request->all())->validate();

      $data = $request->all();

      $task = Task::find($idtask);

      $task->title = $data['title'];
      $task->description = $data['description'];
      $task->lasteditdate = date('Y-m-d H:i:s', strtotime(Carbon::now()));

      $task->save();

      // redirect();
    }
}
