<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminProjectsController extends Controller
{
    public function show()
    {
      return view('admin.projects_card');
    }
}