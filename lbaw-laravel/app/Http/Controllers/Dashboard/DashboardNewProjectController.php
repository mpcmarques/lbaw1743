<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class DashboardNewProjectController extends Controller
{
    public function show()
    {
      return view('new-project');
    }
}