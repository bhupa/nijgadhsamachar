<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Password;
class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

      /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postEmail(Request $request)
    {
        $validator = \Validator::make($request->all(),[
                'email' => 'required|email',
            ]);
            
        if($validator->fails()){
            $errors = $validator->errors()->all();
            return $errors;  
        }
        else{
            //$valid = $this->validate($request, ['email' => 'required|email']);
            
            $response = Password::sendResetLink($request->only('email'), function ( $message) {
                $message->subject('Forget Password');
            });

            switch ($response) {
                case Password::RESET_LINK_SENT:
                    return ['status' => 1];
                    //return response()->json(['status'=> trans($response)]);

                case Password::INVALID_USER:
                    return $response;
                    //return response()->json(['email'=>trans($response)]);
            }

        }

        
    }

    public function checkValidToken($token){
        $reset = new PasswordResets;
        $check = $reset->where('token','=',$token)->count();
        if($check==1)
            return response()->json(['status'=>true]);
        else
            return response()->json(['status'=>false]);
    }

        /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function resetPassword($token)
    {
        
        return view('auth.reset')->withToken($token);
    }

    public function postReset(Request $request,$token)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
            'email' => 'required'
        ]);
        
        if($user_check = \App\User::where('email','=', $request->get('email'))->first() ){
            
            $credentials = $request->only(
                'email', 'password', 'password_confirmation'
            );

            $credentials['token'] = $token;

            $user_check->password = \Hash::make($credentials['password']);

            $user_check->save();

            return redirect()->to('/')->withFlashmessage('password created sucessfully');
        }
        else{
             return redirect()->to('/')->withFlashmessage('some thing went wrong');
        }

        
    }

}
