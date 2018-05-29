<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Model\Project;
use Illuminate\Support\Facades\Auth;
use App\Model\User;
use Carbon\Carbon;

class ProjectController extends Controller {
  public function show($id)
  {
    $project = Project::findOrFail($id);

    return view('project.tasks', ['project' => $project]);
  }

  public function leave($id){
    $project = Project::findOrFail($id);

    if (Auth::check()
          && $project->members->contains('iduser', Auth::user()->iduser)
          && !$project->owner->contains('iduser', Auth::user()->iduser)){
      $project->members()->detach(Auth::user()->iduser);
      $project->lasteditdate = date('Y-m-d H:i:s', strtotime(Carbon::now()));
      $project->save();
    }
    else{
      return redirect('/project/'.$id);
    }

    return redirect('/project/'.$id);
  }

  public function join($id){
    $project = Project::findOrFail($id);

    if (Auth::check()
          && !$project->members->contains('iduser', Auth::user()->iduser)){
      $project->members()->attach(Auth::user()->iduser,[
  'joineddate' => date('Y-m-d H:i:s', strtotime(Carbon::now())),
  'role' => 'Member']);
      $project->lasteditdate = date('Y-m-d H:i:s', strtotime(Carbon::now()));
      $project->save();
    }

    return redirect('/project/'.$id);
  }
}
