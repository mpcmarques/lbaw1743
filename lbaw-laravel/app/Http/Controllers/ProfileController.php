<?php

namespace App\Http\Controllers;

use App\UserTable;

class ProfileController extends Controller
{
    public function show($id)
    {
    
      $profile = UserTable::find($id);

      return view('profile.index', ['profile' => $profile]);
    }
}