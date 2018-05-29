<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Task\TaskController;
use Illuminate\Http\Request;
use App\Model\Task;

class AdminTasksController extends Controller
{
    public function show()
    {
      $tasks = Task::orderBy('idtask', 'ASC')->get();

      return view('admin.tasks_card', ['tasks' => $tasks]);
    }

    public function search(Request $request){
      $text = $request->input('search-task');

      if(is_null($text)){
        return redirect()->back();
      }
      else{
        $tasks = Task::where('title', 'ilike', "%{$text}%")->orderBy('idtask','ASC')->get();
      }

      return view('admin.tasks_card', ['tasks' => $tasks]);
    }

    public function removeTasks(Request $request){
      $data = $request->all();
      $tasks = Task::orderBy('idtask', 'ASC')->get();

      foreach($tasks as $task){
        if(isset($data['task'.$task->idtask])){
          TaskController::deleteTask($task);
        }
      }

      return redirect('/admin/tasks');
    }
}
