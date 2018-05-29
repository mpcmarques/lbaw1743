<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Model\Task;

class DashboardTasksController extends Controller
{
  public function show(){
    $user = Auth::user();

    return view('dashboard.tasks_card', ['tasks' => $user->assignedTasks]);
  }

  public function search(Request $request){
    $text = $request->input('search-my-tasks');
    $user = Auth::user();

    if(is_null($text)){
      return redirect()->back();
    }
    else{
      $tasks = $user->assignedTasks()->where('task.title', 'ilike', "%{$text}%")->get();
    }

    return view('dashboard.tasks_card', ['tasks' => $tasks]);
  }

  public function showCompleted(){
    $user = Auth::user();

    $tasks = $user->assignedTasks()->where('task.completed', 'true')->get();

    return view('dashboard.tasks_card', ['tasks' => $tasks]);
  }

  public function searchCompleted(Request $request){
    $text = $request->input('search-my-tasks');
    $user = Auth::user();

    if(is_null($text)){
      return redirect()->back();
    }
    else{
      $tasks = $user->assignedTasks()->where('task.completed', 'true')->where('task.title', 'ilike', "%{$text}%")->get();
    }

    return view('dashboard.tasks_card', ['tasks' => $tasks]);
  }
}
