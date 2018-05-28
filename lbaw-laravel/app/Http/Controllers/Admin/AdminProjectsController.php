<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Project\ProjectOptionsController;
use Illuminate\Http\Request;
use App\Model\Project;

class AdminProjectsController extends Controller
{
    public function show()
    {
      $projects = Project::orderBy('idproject', 'ASC')->get();

      return view('admin.projects_card', ['projects' => $projects]);
    }

    public function removeProjects(Request $request){
      $data = $request->all();
      $projects = Project::orderBy('idproject', 'ASC')->get();

      foreach($projects as $project){
        if(isset($data['project'.$project->idproject])){
          ProjectOptionsController::delete($project);
        }
      }

      return redirect('/admin/projects');
    }
}
