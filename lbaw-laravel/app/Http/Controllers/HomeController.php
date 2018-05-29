<?php
namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller
{

    use AuthenticatesUsers, RegistersUsers {
        AuthenticatesUsers::redirectPath insteadof RegistersUsers;
        AuthenticatesUsers::guard insteadof RegistersUsers;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'dashboard';

    function show()
    {
        return view('home');
    }

    function showLogin()
    {
        return view('home', ['login' => true]);
    }

    function showRegisterModal()
    {
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
    function sendFailedLoginResponse(Request $request)
    {

        $user = User::where($this->username(), $request->email)->first();

        if (!$user) {
            $message = [$this->username() => trans('auth.email')];
        } else if ($user->password != $request->password) {
            $message = ['password' => trans('auth.password')];
        } else {
            $message = [$this->username() => trans('auth.failed')];
        }

        $exception = ValidationException::withMessages($message);
        $exception->redirectTo('login');

        throw $exception;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) {
      $data = $request->all();
      $data['email'] = $data['emailRegister'];
      $data['password'] = $data['passwordRegister'];
        
      $validator = Validator::make($data, [
        'username' => 'required|string|unique:usertable',
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:usertable',
        'password' => 'required|string|min:6|confirmed',
        'birthdate' => 'required|date',
        'checkbox' => 'required|accepted',
     ]);

      if ($validator->fails()){
        return redirect('register')->withErrors($validator)->withInput();
      }

      $user = new User;
      $user->username = $data['username'];
      $user->password = bcrypt($data['passwordRegister']);
      $user->email = $data['emailRegister'];
      $user->name = $data['name'];
      $user->gender = $data['gender'];
      $user->institution = $data['institution_company'];
      $user->idcountry = $data['country'];
      $user->birthdate = date('Y-m-d H:i:s',strtotime($data['birthdate']));
      $user->premium = false;
      $user->banned = false;
      $user->save();

      if(empty($user)) { // Failed to register user
          return redirect('register'); // Wherever you want to redirect
      }

      $this->guard()->login($user);

      // Success redirection - which will be attribute `$redirectTo`
      return redirect($this->redirectPath());
  }

}
