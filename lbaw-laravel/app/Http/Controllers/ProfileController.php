<?php

namespace App\Http\Controllers;

use App\Model\User;
use App\Model\Project;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function show($id)
    {
      $profile = User::find($id);

      return view('profile.index', ['profile' => $profile]);
    }
}
