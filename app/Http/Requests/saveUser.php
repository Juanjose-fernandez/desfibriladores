<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class saveUser extends FormRequest
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

        $user = $this->route('user');

        if(!$user){
            $id=-1;
        }else{
            $id = $user->id;
        }

        return [
            'username' => 'required|unique:users,username,'.$id,
            'email' => 'required|unique:users,email,' . $id,
            'name' => 'required',
            'surname' => 'required',
            'password'         => 'sometimes|required',
            'password_confirm' => 'sometimes|required|same:password',
            'role_id' => 'required',
            'active' => 'required',
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
        $this->encodePassword();
    }

    protected function encodePassword(){

        if(!$this->route('user')){
            $this->merge(['password'=>bcrypt($this->input('password'))]);
            $this->merge(['password_confirm'=>bcrypt($this->input('password_confirm'))]);
        }
    }


    protected function failedValidation(Validator $validator)
    {
        if(Request::ajax()){
            throw new HttpResponseException(
                response()->json([

                    'data_failed' => $validator->messages(),
                    'title' => __('global.default-form-validation-error-title'),
                    'message' => __('global.default-form-validation-error-msg'),
                ], 422
                )
            );
        }else{
            throw new ValidationException($validator);
        }
    }

}
