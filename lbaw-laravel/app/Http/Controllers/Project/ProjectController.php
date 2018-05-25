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

  public function leave($id, $iduser){
    $project = Project::findOrFail($id);

    if (Auth::user()->iduser == $iduser
          && $project->members->contains('iduser', Auth::user()->iduser)
          && !$project->owner->contains('iduser', Auth::user()->iduser)){
      $project->members()->detach($iduser);
      $project->lasteditdate = date('Y-m-d H:i:s', strtotime(Carbon::now()));
      $project->save();
    }
    else{
      return redirect('/project/'.$id);
    }

    return redirect('/project/'.$id);
  }

  public function join($id, $iduser){
    $project = Project::findOrFail($id);

    if (Auth::check() && Auth::user()->iduser == $iduser
          && !$project->members->contains('iduser', Auth::user()->iduser)){
      $project->members()->attach($iduser,[
  'joineddate' => date('Y-m-d H:i:s', strtotime(Carbon::now())),
  'role' => 'Member']);
      $project->lasteditdate = date('Y-m-d H:i:s', strtotime(Carbon::now()));
      $project->save();
    }
    else{
      return redirect('/project/'.$id);
    }

    return redirect('/project/'.$id);
  }
}
