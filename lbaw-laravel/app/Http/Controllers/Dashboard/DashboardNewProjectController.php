<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DashboardNewProjectController extends Controller
{
    public function show()
    {
      return view('new-project');
    }

    public function editProfile(Request $request) {
      $profile = Auth::user();


    }
}
