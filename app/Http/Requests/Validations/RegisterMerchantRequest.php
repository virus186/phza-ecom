<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class RegisterMerchantRequest extends Request
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
        $this->merge(['role_id' => \App\Models\Role::MERCHANT]);

        $rules =  [
            'shop_name' => 'required|string|max:255|unique:shops,name',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'agree' => 'required',
        ];

        if (is_subscription_enabled()) {
            $rules['plan'] = 'required';
        }

        // When recaptcha in configured and the call is not from api
        if (config('services.recaptcha.key') && !$this->is('api/vendor/*')) {
            $rules['g-recaptcha-response'] = 'required|recaptcha';
        }

        if (is_incevio_package_loaded('otp-login')) {
            $rules['phone'] = 'required|string|unique:users';
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
