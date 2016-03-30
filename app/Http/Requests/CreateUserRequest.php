<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if( $this->has('user_id') && $this->get('user_id') == \Auth::user()->user_id){
            return true;
        }
        
        return true;
    
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        
        return [
             
        'firstname' => 'required|alpha|min:3',
        'lastname' => 'required|alpha|min:3',
         'gender'=>'required_without:user_id|in:Male,Female',
         'address' => 'required',
        'contact' => 'required|numeric|min:8',
        'image' => 'required_without:user_id',
        'email' => 'required_without:user_id|email|unique:users,user_id',
        'user_type'=>'required_without:user_id|in:Admin,Reporter',
        'password' => 'required_without:user_id|alpha_num|min:6',
        'cpassword' => 'required_without:user_id|same:password',   
        ];
    }
}
