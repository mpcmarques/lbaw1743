<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Model\Project;

class ProjectOptionsController extends Controller
{
  public function show($id)
  {
    $project = Project::findOrFail($id);

    return view('project.options_card', ['project' => $project]);
  }

  public function delete($id){
    $project = Project::findOrFail($id);

    $project->delete();

    return redirect()->route('home');
  }
}
