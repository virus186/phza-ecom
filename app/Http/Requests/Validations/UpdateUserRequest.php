<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class UpdateUserRequest extends Request
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
            'name' => 'bail|required|max:255',
            'email' =>  'email|max:255|unique:users,email,' . $this->route('user'),
            'role_id' => 'required',
            'active' => 'required',
            'image' => 'mimes:jpg,jpeg,png',
        ];
    }
}
