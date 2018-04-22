<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardTasksController extends Controller
{
  public function show()
  {
    
    $user = Auth::user();
    
    return view('dashboard.tasks_card', ['user' => $user]);
  }
}