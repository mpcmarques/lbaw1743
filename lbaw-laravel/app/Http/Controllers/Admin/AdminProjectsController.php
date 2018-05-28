<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Project;

class AdminProjectsController extends Controller
{
    public function show()
    {
      $projects = Project::orderBy('idproject', 'ASC')->get();

      return view('admin.projects_card', ['projects' => $projects]);
    }
}
