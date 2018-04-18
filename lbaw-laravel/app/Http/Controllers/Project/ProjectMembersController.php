<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Model\Project;

class ProjectMembersController extends Controller
{
    public function show($id)
    {
      $project = Project::find($id);

      return view('project.members_card', ['project' => $project]);
    }
}
