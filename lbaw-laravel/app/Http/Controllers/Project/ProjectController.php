<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Model\Project;
use Illuminate\Support\Facades\Auth;
use App\Model\User;

class ProjectController extends Controller {
  public function show($id)
  {
    $project = Project::findOrFail($id);

    return view('project.tasks', ['project' => $project]);
  }

  public function leave($id, $iduser){
    $project = Project::find($id);

    if (Auth::user()->iduser == $iduser
          && $project->members->contains('iduser', Auth::user()->iduser)
          && !$project->owner->contains('iduser', Auth::user()->iduser)){
      $project->members()->detach($iduser);
    }
    else{
      return redirect('/project/'.$id);
    }

    return redirect('/project/'.$id);
  }
}
