<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Model\User;
use App\Model\BannedRecord;
use Carbon\Carbon;

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
          $bannedrecord = new BannedRecord;
          $bannedrecord->startdate = date('Y-m-d H:i:s', strtotime(Carbon::now()));
          $bannedrecord->duration = '1 year';
          $bannedrecord->motive = $data['motive'];
          $bannedrecord->iduser = $user->iduser;
          $bannedrecord->idadmin = Auth::user()->iduser;

          $bannedrecord->save();
        }
      }

      return redirect('/admin/users');
    }
}
