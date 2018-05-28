<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller{

  use AuthenticatesUsers, RegistersUsers {
      AuthenticatesUsers::redirectPath insteadof RegistersUsers;
      AuthenticatesUsers::guard insteadof RegistersUsers;
  }

  protected $redirectTo = 'admin/users';

  public function show()
  {
    if(Auth::check()){
      return redirect('admin/users');
    }
    else{
      return view('admin.index');
    }
  }

}
