<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller {
  
  use AuthenticatesUsers, RegistersUsers {
    AuthenticatesUsers::redirectPath insteadof RegistersUsers;
    AuthenticatesUsers::guard insteadof RegistersUsers;
  }
  
  
  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
    $this->middleware('guest');
  }
  
  /**
  * Where to redirect users after registration.
  *
  * @var string
  */
  protected $redirectTo = 'dashboard';
  
  public function show() {
    return view('home');
  }
  
  public function showLogin(){
    return view('home', ['login' => true]);
  }

  public function showRegisterModal(){
    return view('home', ['showRegisterModal' => true]);
  }
  
  /**
  * Get the failed login response instance.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Symfony\Component\HttpFoundation\Response
  *
  * @throws ValidationException
  */
  protected function sendFailedLoginResponse(Request $request)
  {
    
    $user = User::where($this->username(), $request->email)->first();
    
    if (!$user){
      $message = [$this->username() => trans('auth.email')];
    }

    else if ($user->password != $request->password){
      $message = ['password' => trans('auth.password')];
    }

    else {
      $message = [$this->username() => trans('auth.failed')];
    }
    
    $exception = ValidationException::withMessages($message);
    $exception->redirectTo('login');

    throw $exception;
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