<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class RegisterCustomerRequest extends Request
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
        $rules = [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|max:255|unique:customers',
            'password' => 'required|string|min:6|confirmed',
            'agree' => 'required',
        ];

        if (is_incevio_package_loaded('otp-login')) {
            $rules['phone'] = 'required|string|max:255|unique:customers';
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.unique' => trans('validation.register_email_unique'),
        ];
    }
}
