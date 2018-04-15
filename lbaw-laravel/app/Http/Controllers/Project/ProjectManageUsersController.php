<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;

class ProjectManageUsersController extends Controller
{
    public function show()
    {
      return view('project.manage_users_card');
    }
}