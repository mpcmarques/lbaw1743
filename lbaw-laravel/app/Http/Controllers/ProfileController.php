<?php

namespace App\Http\Controllers;

use App\Model\User;
use App\Model\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($id)
    {
      $profile = User::find($id);

      return view('profile.index', ['profile' => $profile]);
    }

    function showEditModal($id)
    {
      $profile = User::find($id);

      return view('profile.index', ['profile' => $profile], ['editProfile' => true]);
    }


    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editProfile(Request $request) {
      // echo $request;
  }

}
