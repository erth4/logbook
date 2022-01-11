<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateUserRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'role'                  => 'required',
            'name'                  => 'required',
            'email'                 => 'required|unique:users,email,' . $request->input('id'). '',
            'phone'                 => 'required|unique:users,phone,' . $request->input('id'). '',
            'address'               => 'required',
            'password'              => 'confirmed',
            'password_confirmation' => '',
            'identity_number'       => 'required|unique:users,identity_number,' . $request->input('id'). '',
        ];
    }
}
