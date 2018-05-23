<?php

namespace App\Http\Controllers;

use App\Model\User;
use App\Model\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

  function validator(array $data)
  {
      return Validator::make($data, [
          'username' => 'required|string|unique:usertable',
          'name' => 'required|string|max:255',
          'emailProfile' => 'required|string|email|max:255|unique:usertable',
          'passwordProfile' => 'required|string|min:6|confirmed',
          'birthdate' => 'required|date',
      ]);
  }

  /**
   * Handle a update request for the application.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function editProfile(Request $request) {
    $profile = Auth::user();
    // $this->validator($request->all())->validate();
    $data = $request->all();

    //TODO validate only what changes

    if($request->has('profilePicture')){
      $request->profilePicture->move(public_path().'/img/profile/', $profile->iduser.'.png');
    }

    if($data['name'] != $profile->name){
        $profile->name = $data['name'];
    }

    if($data['username'] != $profile->username){
        $profile->username = $data['username'];
    }

    if($data['emailProfile'] != $profile->email){
        $profile->email = $data['emailProfile'];
    }

    if($data['institution'] != $profile->institution){
        $profile->institution = $data['institution'];
    }

    if($data['birthdate'] != $profile->birthdate){
        $profile->birthdate = $data['birthdate'];
    }

    if(bcrypt($data['passwordProfile']) != $profile->password
        && $data['passwordProfile'] == $data['password_confirmation']){
        $profile->password = bcrypt($data['passwordProfile']);
    }

    $profile->save();

    return redirect('/profile/'.$profile->iduser);
}

}
