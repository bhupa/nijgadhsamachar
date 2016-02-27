<?php

namespace App\Http\Controllers\Auth;
use \Illuminate\Http\Response;
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
protected $redirectAfterLogout = 'User/index';

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
        
    if ( (\Auth::user()->by_admin != 1) && (\Auth::user()->status !=="Active") )
      {
          return $this->logout()->withFlashMessage('Register but do not have permission for login');

      }

      else
      {
        return \Redirect::to('User/index')
            ->withFlashMessage('login sucesfully');

      }
     }
}
