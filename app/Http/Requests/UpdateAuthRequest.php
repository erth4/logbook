<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAuthRequest extends FormRequest
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
            'name'                  => 'required',
            'email'                 => 'required|unique:users,email,' . auth()->user()->id. '',
            'phone'                 => 'required|unique:users,phone,' . auth()->user()->id. '',
            'address'               => 'required',
            'password'              => 'confirmed',
            'password_confirmation' => '',
            'identity_number'       => 'required|unique:users,identity_number,' . auth()->user()->id. '',
        ];
    }
}
