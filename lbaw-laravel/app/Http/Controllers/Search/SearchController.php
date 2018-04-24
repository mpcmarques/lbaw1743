<?php

namespace App\Http\Controllers\Search;

use App\Model\Project;
use App\Model\User;
use App\Model\Task;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller{
  public function search(Request $request){
    $text = $request->input('search-text');

    if(is_null($text)){
      return redirect()->back();
    }
    else{
      return redirect('/search/'.$text);
    }
  }

  public function show($text){
    $projects = Project::nameDescription($text)->get();
    $tasks = Task::titleDescription($text)->get();
    $users = User::usernameName($text)->get();

    if($projects->isEmpty() && $tasks->isEmpty() && $users->isEmpty()){
      //no results
    }

    if($projects->count() >= $tasks->count() && $projects->count() >= $users->count()){
      return view('search.projects_card', ['text' => $text, 'projects' => $projects]);
    } else if($tasks->count() >= $projects->count() && $tasks->count() >= $users->count()){
      return view('search.tasks_card', ['text' => $text, 'tasks' => $tasks]);
    } else{
      return view('search.users_card', ['text' => $text, 'users' => $users]);
    }
  }
}
