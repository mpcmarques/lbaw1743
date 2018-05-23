<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Model\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

  function validator(array $data)
  {
      return Validator::make($data, [
          'title' => 'required|string',
          'description' => 'required|string',
          'private' => 'required'
      ]);
  }

  public function editProject(Request $request, $idproject){
    // $this->validator($request->all())->validate();

    $data = $request->all();

    $project = Project::findOrFail($idproject);

    if($request->has('projectPicture')){
      $request->projectPicture->move(public_path().'/img/project/', $project->idproject.'.png');
    }

    $project->name = $data['name'];
    $project->description = $data['description'];
    $project->private = $data['private'];

    $project->save();

    return redirect('/project/'.$idproject);
  }
}
