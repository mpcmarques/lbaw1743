<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Model\User;

class AdminUsersController extends Controller
{
    public function show()
    {
      $users = User::where('type', 'user')->orderBy("iduser", "ASC")->get();

      return view('admin.users_card', ['users' => $users]);
    }

    public function removeUsers(Request $request){
      $data = $request->all();
      $users = User::where('type', 'user')->orderBy("iduser", "ASC")->get();

      foreach($users as $user){
        if(isset($data['user'.$user->iduser])){
          ProfileController::delete($user);
        }
      }

      return redirect('/admin/users');
    }

    public function promoteUsers(Request $request){
      $data = $request->all();
      $users = User::where('type', 'user')->orderBy("iduser", "ASC")->get();

      foreach($users as $user){
        if(isset($data['user'.$user->iduser])){
          $user->type = 'admin';
          $user->save();
        }
      }

      return redirect('/admin/users');
    }

    public function banUsers(Request $request){
      $data = $request->all();
      $users = User::where('type', 'user')->orderBy("iduser", "ASC")->get();

      foreach($users as $user){
        if(isset($data['user'.$user->iduser])){
          
        }
      }

      return redirect('/admin/users');
    }
}
