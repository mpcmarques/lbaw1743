<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Model\Project;

class ProjectManageUsersController extends Controller
{
  public function show($id)
  {
    $project = Project::findOrFail($id);
    $members = $project->members();
    $tasksAssignedForMembers = array();

    // foreach ($members as $member) {
    //   $member->assignedTasksForProject($project->idproject);
    // }

    return view('project.manage_users_card', ['project' => $project]);
  }
}
