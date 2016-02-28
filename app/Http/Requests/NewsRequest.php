<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NewsRequest extends Request
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
           'title' => 'required|unique',
          'image' => 'required',
          'body' => 'required',
         
        ];

    }
    public function messages()
    {
        return [
            'title.required' => 'Please provide a title for News',  
            'image.required' => 'pls upload your image file',
           
        ];
    }
}
