<?php

namespace App\Http\Controllers\Auth;
use \Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Users;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */

protected $redirectTo = 'User/index';
protected $redirectAfterLogout = '/';

protected $email = 'email';
protected $password = 'password';
 protected $redirectPath = 'User/index';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
 //     public function __construct()
 //     {
 // $this->middleware(['guest'], ['except' => 'getlogout']);
 //  }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    protected function authenticated($user)
    {

    if ( (\Auth::user()->by_admin == Null) or (\Auth::user()->status !== "Active") )
      {

          return $this->logout()->withFlashMessage('Register but do not have permission for login');
      }
      else
      {
            if(\Session::has('reffer'))
            {
                $url = \Session::get('reffer');
                \Session::forget('reffer');
                return redirect()->to($url);
            }

            return redirect()->to('User/index');
      }
     }

     public function ajaxLogin(Request $request)
     {
        
        if (\Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')]))
        {
            if((\Auth::user()->by_admin == Null) or (\Auth::user()->status !== "Active"))
            {
                \Auth::logout();
                return response()->json(['invalid' =>["Register but do not have permission for login"]],425);
            }
            else
            {
            return ['success' => true];
            }
        }

        return response()->json(['invalid' => ["Password and email doesn't match"]],425);
     }
}
