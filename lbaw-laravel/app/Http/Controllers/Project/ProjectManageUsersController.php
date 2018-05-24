<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Model\Project;

class ProjectManageUsersController extends Controller{
  public function show($id){
    $project = Project::findOrFail($id);

    return view('project.manage_users_card', ['project' => $project]);
  }

  public function remove(Request $request, $id){

  }

  public function update(Request $request, $id){

  }
}
