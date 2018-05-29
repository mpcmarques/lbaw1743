<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Project;

class ProjectMembersController extends Controller
{
  public function show($id){
    $project = Project::findOrFail($id);

    return view('project.members_card', ['project' => $project, 'members' => $project->members]);
  }

  public function showManager($id){
    $project = Project::findOrFail($id);

    return view('project.members_card', ['project' => $project, 'members' => $project->managers]);
  }

  public function showMember($id){
    $project = Project::findOrFail($id);

    return view('project.members_card', ['project' => $project, 'members' => $project->onlyMembers]);
  }
}
