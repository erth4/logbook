<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
        return [
            'role'                  => 'required',
            'identity_number'       => 'required|unique:users,identity_number',
            'name'                  => 'required',
            'email'                 => 'required|unique:users,email',
            'phone'                 => 'required|unique:users,phone',
            'address'               => 'required',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ];
    }
}
