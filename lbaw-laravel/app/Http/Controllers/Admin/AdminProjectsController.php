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

    public function search(Request $request){
      $text = $request->input('search-project');

      if(is_null($text)){
        return redirect()->back();
      }
      else{
        $projects = Project::where('name', 'ilike', "%{$text}%")->orderBy('idproject','ASC')->get();
      }

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
