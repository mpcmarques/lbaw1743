<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class HomeController extends Controller {
  
  use AuthenticatesUsers, RegistersUsers {
    AuthenticatesUsers::redirectPath insteadof RegistersUsers;
    AuthenticatesUsers::guard insteadof RegistersUsers;
  }
  
  
  /**
  * Where to redirect users after registration.
  *
  * @var string
  */
  protected $redirectTo = '/dashboard';
  
  
  
  public function show() {
    return view('home');
  }
  
  public function showLogin(){
    return view('home', ['login' => true]);
  }
  
  protected function validator(array $data){
    
    return Validator::make($data, [
      'username' => 'required|string|unique:usertable',
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:usertable',
      'password' => 'required|string|min:6|confirmed',
      'birthdate' => 'required|date',
      'checkbox' => 'required|accepted'
      ]);
    }
    
    protected function create(array $data){
      
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
        'username' => $data['username'],
        'institution' => $data['institution']
        ]);
      }
      
    }