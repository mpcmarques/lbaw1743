<?php

namespace App\Http\Controllers;

use App\Model\User;

class ProfileController extends Controller
{
    public function show($id)
    {
      $profile = User::find($id);

      return view('profile.index', ['profile' => $profile]);
    }
}
