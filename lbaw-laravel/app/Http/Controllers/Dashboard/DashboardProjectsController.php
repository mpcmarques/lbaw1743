<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class DashboardProjectsController extends Controller
{
    public function show()
    {
      return view('dashboard.tasks_card');
    }
}