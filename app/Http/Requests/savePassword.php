<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;

class savePassword extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $a=3;

        $old_pass_input = bcrypt($this->input('old_user_password'));
        if (Hash::check($this->input('old_user_password'), Auth::user()->getPassword())){
            $valor=$this->input('old_user_password');
        }else{
            $valor=$old_pass_input;
        }

        return [
            'old_user_password'=>'required|in:'.$valor,
            'user_password'=>'required',
            'user_password_confirm'=>'same:user_password'
        ];

    }
    public function messages()
    {
        return [

            'old_user_password.in' => Lang::get('users/messages.error.in.password'),
            'user_password.required' => Lang::get('users/messages.error.required'),
            'user_password_confirm.same' => Lang::get('users/messages.error.same.password'),
        ];
    }
}
