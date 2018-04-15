<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;

class ProjectForumController extends Controller
{
    public function show()
    {
      return view('project.forum_card');
    }
}