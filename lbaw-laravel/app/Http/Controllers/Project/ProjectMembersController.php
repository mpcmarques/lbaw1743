<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;

class ProjectMembersController extends Controller
{
    public function show()
    {
      return view('project.members_card');
    }
}