<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

class HomeController extends Controller
{
  
  use AuthenticatesUsers;
  
  
  public function show()
  {
    return view('home');
  }
  
  /**
  * Where to redirect users after login.
  *
  * @var string
  */
  protected $redirectTo = '/dashboard';
}