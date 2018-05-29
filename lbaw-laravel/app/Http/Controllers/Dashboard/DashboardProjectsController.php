<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Model\Project;

class DashboardProjectsController extends Controller
{
  public function show(){
    $user = Auth::user();
    $projects = $user->projects;

    return view('dashboard.my_projects_card', ['projects' => $projects]);
  }

  public function search(Request $request){
    $text = $request->input('search-my-projects');
    $user = Auth::user();

    if(is_null($text)){
      return redirect()->back();
    }
    else{
      $projects = $user->projects()->where('project.name', 'ilike', "%{$text}%")->get();
    }

    return view('dashboard.my_projects_card', ['projects' => $projects]);
  }
}
