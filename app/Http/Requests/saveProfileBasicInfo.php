<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class saveProfileBasicInfo extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->input('user_id') == Auth::user()->getId()){
            return true;
        }else{
            return false;
        }

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'user_name'   => 'required',
            'user_surname' => 'required',
            'user_username'    => 'required',
            'user_email'=>'required|unique:users,email,'.$this->input('user_id'),
            'rest_time'=>'date_format:H:i',
            'study_time'=>'date_format:H:i',
        ];
    }

    protected function getValidatorInstance()
    {
        return parent::getValidatorInstance()->after(function ($validator) {
            // Call the after method of the FormRequest (see below)
            $this->after($validator);
        });
    }

    public function after($validator){
        $this->formatDate();
    }
    public function formatDate(){
        if($this->input('birth_date')){
            $this->merge(['birth_date'=>Carbon::createFromFormat('d/m/Y',$this->input('birth_date'))->format('Y-m-d')]);
        }
    }


    public function messages()
    {
        return [
            'user_username.required' => Lang::get('users/messages.error.required'),
            'user_name.required' => Lang::get('users/messages.error.required'),
            'user_surname.required' => Lang::get('users/messages.error.required'),
            'user_email.required' => Lang::get('users/messages.error.required'),
            'user_email.unique' => Lang::get('users/messages.error.email.unique'),

        ];
    }


}
