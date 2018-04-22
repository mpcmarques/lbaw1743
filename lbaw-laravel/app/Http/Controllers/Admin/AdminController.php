<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminController extends Controller{
  public function show()
  {
    return view('admin.index');
  }
  
  public function login(Request $request){
    
    $validated = $request->validate([
      'email' => 'required|email',
      'password' => 'required'
    ]);
    
    // TODO: finish admin auth

    print(implode(" ", $validated)); 
  }
}