<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Project;

class AdminProjectsController extends Controller
{
    public function show()
    {
      $projects = Project::all();

      return view('admin.projects_card', ['projects' => $projects]);
    }
}