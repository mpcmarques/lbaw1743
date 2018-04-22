<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardProjectsController extends Controller
{
  public function show()
  {
    $user = Auth::user();
    
    return view('dashboard.my_projects_card', ['user' => $user]);
  }
}